<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asigment;

class PaymentController extends Controller
{
    public function index($id)
    {
        $asigment = Asigment::findOrFail($id);

        return view()->component(
            'payment',
            ['title' => 'Pago'],
            ['asigment' => $asigment]
        );
    }
}
