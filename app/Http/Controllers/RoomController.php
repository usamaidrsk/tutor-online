<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RoomController extends Controller
{
    public function index($id)
    {
        $asigment = \App\Asigment::findOrFail($id);

        // Only can enter class room if the asigment is between `evaluating` and `finished`
        // and that is `waiting-for-class` status.
        abort_if($asigment->status !== 'waiting-for-class', 404);

        $user = auth()->user();

        // Fetch teacher
        if ($user->isNot('teacher')) {
            $teacher = \App\Teacher::findOrFail($asigment->teacher_id);
            $teacher = array_merge(
                $teacher->user->toArray(),
                $teacher->toArray()
            );
        }

        return view()->component(
            'room',
            ['title' => 'Clase online'],
            [
                'roomName' => "Clase online | $id",
                'displayName' => $user->full_name,
                'asigment' => $asigment,
                'teacher' => $teacher ?? null,
            ]
        );
    }
}
