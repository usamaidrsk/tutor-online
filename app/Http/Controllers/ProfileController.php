<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        if (!auth()->user()->answered_questions) {
            return redirect()->route('questions', 1);
        }

        $id = auth()->user()->id;
        $teacher = Teacher::with('address', 'schedule')->findOrFail($id);

        $invitations = $teacher
            ->invitations()
            ->with('asigment')
            ->where('is_acepted', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $rooms = $teacher
            ->rooms()
            ->with('asigment')
            ->get();

        return view()->component(
            'profile.index',
            ['title' => $teacher->first_name],
            [
                'teacher' => $teacher,
                'invitations' => $invitations,
                'rooms' => $rooms,
            ]
        );
    }

    public function edit()
    {
        if (!auth()->user()->answered_questions) {
            return redirect()->route('questions', 1);
        }

        $id = auth()->user()->id;
        $teacher = Teacher::with(
            'levels',
            'categories',
            'address',
            'bank'
        )->findOrFail($id);

        return view()->component(
            'profile.edit',
            ['title' => 'Editar'],
            [
                'teacher' => $teacher,
                'categories' => DB::table('categories')->get(),
                'levels' => DB::table('levels')->get(),
                'countries' => DB::table('countries')
                    ->get()
                    ->map(function ($country) {
                        return [
                            'value' => $country->id,
                            'label' => $country->name,
                        ];
                    }),
            ]
        );
    }

    public function update()
    {
        request()->validate(
            [
                'first_name' => ['required', 'string', 'min:4', 'max:25'],
                'last_name' => ['required', 'string', 'min:4', 'max:25'],
                'country_id' => 'required|numeric|exists:countries,id',
                'birthday' => 'required|date',

                // 'phone_prefix' => 'required|regex:/^(\+)([1-9]{2})$/',
                // 'phone' => 'phone:AUTO,' . implode(',', $codes),

                'address.country_id' => 'required|numeric|exists:countries,id',
                'address.city' => 'required|max:50',
                'address.line' => 'required|max:100',
                'address.zip_code' => 'required|max:10',
                'address.state' => 'required|max:50',

                'levels' => 'required|array|exists:levels,id',
                'categories' => 'required|array|exists:categories,id',
            ],
            [
                // 'phone_prefix.regex' =>
                //         'Debes suministrar un código de país valido.',
                'levels.required' =>
                    'Debes elegir al menos un nivel de educación',
                'categories.required' =>
                    'Deber elegir al menos una especialidad',
            ]
        );

        $id = auth()->user()->id;
        $teacher = Teacher::findOrFail($id);

        $teacher->update(
            request()->only([
                'first_name',
                'last_name',
                'country_id',
                'birthday',
            ])
        );

        $teacher->address()->update(request()->input('address'));
        $teacher->bank()->updateOrCreate(request()->input('bank'));
        $teacher->levels()->sync(request()->input('levels'));
        $teacher->categories()->sync(request()->input('categories'));
    }
}
