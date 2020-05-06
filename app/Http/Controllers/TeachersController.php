<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;

class TeachersController extends Controller
{
    public function update($id)
    {
        $teacher = Teacher::findOrfail($id);
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
}
