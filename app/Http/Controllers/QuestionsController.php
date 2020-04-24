<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QuestionsController extends Controller
{
    const MAX_PICTURE_SIZE = 100 * 1024; // 100 KB
    const ALLOWED_PICTURE_EXTENSIONS = ['png', 'jpg', 'jpeg'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $step)
    {
        if (auth()->user()->answered_questions) {
            return redirect('profile');
        }

        if (!session()->has('answers')) {
            session()->put('answers', []);
        }

        if ($step > 1 && !isset(session()->get('answers')[$step - 2])) {
            return redirect('questions/' . ($step - 1));
        }

        $old = (object) (session()->get('answers')[$step - 1] ?? []);

        $props = [];

        switch ($step) {
            case 1:
            case 2:
                $props += [
                    'countries' => DB::table('countries')
                        ->get()
                        ->map(function ($country) {
                            return [
                                'value' => $country->id,
                                'label' => $country->name,
                            ];
                        }),
                ];

            case 1:
                $props += [
                    'categories' => DB::table('categories')->get(),
                    'levels' => DB::table('levels')->get(),
                ];
                break;

            case 3:
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
                // $rules += ['phone' => 'phone|max:15']; // TODO: validate properly
                break;

            case 3:
                $rules = [
                    'picture' =>
                        'required|image|mimes:' .
                        implode(',', $this::ALLOWED_PICTURE_EXTENSIONS) .
                        '|max:' .
                        $this::MAX_PICTURE_SIZE / 1024,
                ];
                break;
        }

        $validatedData = request()->validate($rules, $messages);

        if ($step < 3) {
            $answers = session()->get('answers') ?? [];
            $answers[$step - 1] = request()->all();
            session()->put('answers', $answers);
            return;
        }

        $user = auth()->user();
        $answers = session()->get('answers');
        $input = array_merge($answers[0], $answers[1]);
        $picture = request()->file('picture');

        // #1
        $user->country_id = $input['country'];
        $user->birthday = \Carbon\Carbon::parse($input['birthday']);
        $user->levels()->sync($input['levels']);
        $user->categories()->sync($input['categories']);

        // #2
        $user->phone = $input['phone'];

        $address = $input['address'];
        $user->address()->create([
            'line' => $address['line'],
            'state' => $address['state'],
            'city' => $address['city'],
            'zip_code' => $address['zip_code'],
            'country_id' => $address['country'],
        ]);

        // #3
        $user->picture = $picture->store('pictures');

        $user->answered_questions = true;
        $user->save();

        session()->forget('answers');
    }
}
