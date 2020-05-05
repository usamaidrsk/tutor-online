<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asigment;
use App\Teacher;

class RoomController extends Controller
{
    public function index($id)
    {
        $asigment = Asigment::findOrFail($id);
        $room = $asigment->room;

        if (!$room) {
            return redirect()->route('asigment.show', $asigment->id);
        }

        $teacher = Teacher::findOrFail($room->teacher_id);

        return view()->component(
            'room',
            ['title' => 'Clase online'],
            [
                'roomName' => 'Clase online',
                'displayName' => auth()->check()
                    ? auth()->user()->full_name
                    : 'Estudiante',

                'asigment' => $asigment,
                'teacher' => $teacher,
            ]
        );
    }
}
