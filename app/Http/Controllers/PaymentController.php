<?php

namespace App\Http\Controllers;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

use App\Asigment;
use App\Teacher;
use App\Room;

class PaymentController extends Controller
{
    private $api_context;

    public function __construct()
    {
        $this->api_context = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        $this->api_context->setConfig(config('paypal.settings'));
    }

    public function index()
    {
        $asigment = $this->getAsigment();

        if (!$asigment) {
            return redirect()->route('asigment.create');
        }

        // If the asigment is already paid, redicrect to chat page
        if ($asigment->payment) {
            return redirect()->route('room', $asigment->room->token);
        }

        $teacher_id = request()->query('teacher_id');

        // Make sure that teacher exist and was invitated to this asigment
        $invitation = $asigment
            ->invitations()
            ->where('teacher_id', $teacher_id)
            ->first();

        if (!$invitation) {
            return redirect()->route('asigment.index');
        }

        session()->put('teacher_id', $teacher_id);

        $error = session()->get('error');
        session()->forget('error');

        return view()->component(
            'payment.index',
            ['title' => 'Pago'],
            [
                'amount' => $asigment->budget,
                'error' => $error,
            ]
        );
    }

    public function success()
    {
        return view()->component('payment.success', [
            'title' => 'Pago exitoso',
        ]);
    }

    public function create()
    {
        $asigment = $this->getAsigment();

        $currency = config('app.currency_code');
        $amount_payable = $asigment->budget;
        $invoice_number = uniqid();
        $description = 'Clase online';

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Create and setup the total amount.
        $amount = new Amount();
        $amount->setCurrency($currency)->setTotal($amount_payable);

        // Create a transaction and amount and description.
        $transaction = new Transaction();
        $transaction
            ->setAmount($amount)
            ->setDescription($description)
            ->setInvoiceNumber($invoice_number);

        // Create a redirect urls, cancel url brings us back to current page, return url takes us to confirm payment.
        $redirect_urls = new RedirectUrls();
        $redirect_urls
            ->setReturnUrl(route('payment.execute'))
            ->setCancelUrl(route('payment.index'));

        // We set up the payment with the payer, urls and transactions.
        $payment = new Payment();
        $payment
            ->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirect_urls);

        // Put the payment creation in try and catch in case of exceptions.
        try {
            $payment->create($this->api_context);
        } catch (Exception $e) {
            report($e);
            return $this->handleError();
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        if (isset($redirect_url)) {
            return redirect()->away($redirect_url);
        }

        return $this->handleError();
    }

    public function execute()
    {
        $request = request();

        // If query data not available... no payments was made.
        if (
            empty($request->query('paymentId')) ||
            empty($request->query('PayerID'))
        ) {
            return $this->handleError();
        }

        // We retrieve the payment from the paymentId.
        $payment = Payment::get(
            $request->query('paymentId'),
            $this->api_context
        );

        // We create a payment execution with the PayerId
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));

        try {
            // Then we execute the payment.
            $payment->execute($execution, $this->api_context);
            $this->afterPaymentExecute($payment);
        } catch (\Exception $e) {
            report($e);
            return $this->handleError();
        }

        return redirect()->route('payment.success');
    }

    private function afterPaymentExecute($payment)
    {
        $asigment = $this->getAsigment();

        // Store payment in database
        $asigment->payment()->create([
            'transaction_id' => $payment->getId(),
            'invoice_id' => $payment->transactions[0]->invoice_number,
            'amount' => $payment->transactions[0]->amount->total,
        ]);

        // Create room
        $asigment->room()->create([
            'token' => Str::random(10),
            'teacher_id' => session()->get('teacher_id'),
        ]);
    }

    private function getAsigment()
    {
        return Asigment::where('email', Cookie::get('email'))->first();
    }

    private function handleError(
        $message = 'Hubo un error al procesar su pago. Disculpe el inconveniente.'
    ) {
        session()->put('error', $message);
        return redirect()->route('payment.index');
    }
}
