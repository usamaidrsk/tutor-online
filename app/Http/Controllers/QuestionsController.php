<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Storage;
use DB;
use Image;

class QuestionsController extends Controller
{
    const MAX_PICTURE_SIZE = 100 * 1024; // 100 KB
    const ALLOWED_PICTURE_EXTENSIONS = ['png', 'jpg', 'jpeg'];
    const TOTAL_STEPS = 4;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $step)
    {
        // Redirect to profile if user has already
        //  completed this process
        if (auth()->user()->answered_questions) {
            return redirect('profile');
        }

        // Set `answers` session variable to an array
        // in case this is the first time the use visits
        // this page
        if (!session()->has('answers')) {
            session()->put('answers', []);
        }

        // Redirect back if tries to get to an
        // step before answering the previous one
        if ($step > 1 && !isset(session()->get('answers')[$step - 2])) {
            return redirect(route('questions', $step - 1));
        }

        // Get anwers from previous step
        $old = (object) (session()->get('answers')[$step - 1] ?? []);

        $props = [];

        // Get specific props data to requeste step
        switch ($step) {
            case 1:
            case 2:
                $countries = DB::table('countries')->get();

                // Map countries array to be usable by Select component
                $mapped = $countries->map(function ($country) {
                    return [
                        'value' => $country->id,
                        'label' => $country->name,
                    ];
                });

                $props += ['countries' => $mapped];

            case 1:
                $props += [
                    'categories' => DB::table('categories')->get(),
                    'levels' => DB::table('levels')->get(),
                ];
                break;

            case 3:
                $props += [];
                break;

            case 4:
                $props += [
                    'MAX_PICTURE_SIZE' => $this::MAX_PICTURE_SIZE,
                    'ALLOWED_PICTURE_EXTENSIONS' =>
                        $this::ALLOWED_PICTURE_EXTENSIONS,
                ];
                break;
        }

        return view()->component(
            'questions',
            ['title' => 'Preguntas'],
            [
                'step' => $step,
                'TOTAL_STEPS' => $this::TOTAL_STEPS,
                'props' => array_merge(['old' => $old], $props),
            ]
        );
    }

    public function store(int $step)
    {
        $rules = [];
        $messages = [];

        switch ($step) {
            case 1:
                $rules = [
                    'country' => 'required|numeric|exists:countries,id',
                    'birthday' => 'required|date',
                    'levels' => 'required|array|exists:levels,id',
                    'categories' => 'required|array|exists:categories,id',
                ];

                $messages = [
                    'levels.required' =>
                        'Debes elegir al menos un nivel de educación',
                    'categories.required' =>
                        'Deber elegir al menos una especialidad',
                ];

                break;

            case 2:
                $codes = DB::table('countries')
                    ->select('code')
                    ->get()
                    ->map(function ($country) {
                        return $country->code;
                    })
                    ->toArray();

                $rules += [
                    'phone_prefix' => 'required|regex:/^(\+)([1-9]{2})$/',
                    'phone' => 'phone:AUTO,' . implode(',', $codes),
                    'address.country' => 'required|numeric|exists:countries,id',
                    'address.city' => 'required|max:50',
                    'address.line' => 'required|max:100',
                    'address.zip_code' => 'required|max:10',
                    'address.state' => 'required|max:50',
                ];

                $messages += [
                    'phone_prefix.regex' =>
                        'Debes suministrar un código de país valido.',
                ];

                break;

            case 3:
                $rules = ['schedule' => 'required'];
                break;

            case 4:
                $image_mimes = implode(',', $this::ALLOWED_PICTURE_EXTENSIONS);
                $max_size = $this::MAX_PICTURE_SIZE / 1024;

                $rules = [
                    'picture' => "required|image|mimes:$image_mimes|max:$max_size",
                ];
                break;
        }

        request()->validate($rules, $messages); // Validate input with step rules

        // If is no the last question persist given input
        // in a session varible to be used later
        if ($step < $this::TOTAL_STEPS) {
            $answers = session()->get('answers') ?? [];
            $answers[$step - 1] = request()->all();
            session()->put('answers', $answers);
            return;
        }

        // Finally, if last step was submited store all given answers

        $user = auth()->user();
        $answers = session()->get('answers');
        $input = array_merge($answers[0], $answers[1], $answers[2]);
        $picture = request()->file('picture');

        // #1 | Store general information

        $user->country_id = $input['country'];
        $user->birthday = \Carbon\Carbon::parse($input['birthday']);
        $user->levels()->sync($input['levels']);
        $user->categories()->sync($input['categories']);

        // #2 | Store given phone and address

        $phone = $input['phone_prefix'] . $input['phone'];
        $user->phone = (string) PhoneNumber::make($phone);

        $address = $input['address'];

        $user->address()->create([
            'line' => $address['line'],
            'state' => $address['state'],
            'city' => $address['city'],
            'zip_code' => $address['zip_code'],
            'country_id' => $address['country'],
        ]);

        // #3 | Parse and store teacher's schedule

        $schedule = [];

        foreach ($input['schedule'] as $key => $value) {
            if (count($value)) {
                foreach ($value as $range) {
                    [$start, $end] = $range;
                    $schedule[] = [
                        'start' => "$start:00:00",
                        'end' => "$end:00:00",
                        'day_of_week' => $key,
                    ];
                }
            }
        }

        $user->schedule()->createMany($schedule);

        // #4 | Resize and save user picture

        $image_path = "pictures/{$user->id}.jpg";
        $image_full_path = storage_path("app/public/$image_path");

        Storage::makeDirectory('/pictures');

        Image::make($picture)
            ->fit(216)
            ->save($image_full_path, 75);

        $user->picture = "/storage/$image_path";


        // Finaly | Save teacher's changes

        $user->answered_questions = true;
        $user->save();

        session()->forget('answers');
    }
}
