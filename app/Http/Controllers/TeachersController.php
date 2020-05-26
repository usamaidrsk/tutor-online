<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function update($id)
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

        $teacher = \App\Teacher::findOrFail($id);
        $user = $teacher->user();

        $user->update(request()->only(['first_name', 'last_name']));
        $teacher->update(request()->only(['country_id', 'birthday']));
        $teacher->address()->update(request()->input('address'));
        $teacher->bank()->updateOrCreate(request()->input('bank'));
        $teacher->levels()->sync(request()->input('levels'));
        $teacher->categories()->sync(request()->input('categories'));
    }

    public function updateSchedule($id)
    {
        $teacher = \App\Teacher::findOrfail($id);
        $new_schedule = [];

        foreach (request()->input('schedule') as $key => $value) {
            if (count($value)) {
                foreach ($value as $range) {
                    [$start, $end] = $range;
                    $new_schedule[] = [
                        'start' => "$start:00:00",
                        'end' => "$end:00:00",
                        'day_of_week' => $key,
                    ];
                }
            }
        }

        $teacher->schedule()->delete();
        $teacher->schedule()->createMany($new_schedule);
    }

    public function updateStatus($id)
    {
        $teacher = \App\Teacher::findOrFail($id);
        $teacher->status = request()->input('status');
        $teacher->save();
    }
}
