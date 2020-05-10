<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Room;
use App\Asigment;
use App\Teacher;

class RoomController extends Controller
{
    public function index($token = null)
    {
        if ($token) {
            $room = Room::where('token', $token)->first();
            abort_if(!$room, 404);
            $asigment = Asigment::findOrFail($room->asigment_id);
            $teacher = Teacher::findOrFail($room->teacher_id);
        } else {
            $email = Cookie::get('email');
            $asigment = Asigment::where('email', $email)->first();

            if (!$asigment) {
                return redirect()->route('asigment.create');
            }

            $room = $asigment->room;

            if (!$room) {
                return redirect()->route('asigment.index');
            }

            $teacher = Teacher::findOrFail($room->teacher_id);
        }

        return view()->component(
            'room',
            ['title' => 'Clase online'],
            [
                'roomName' => 'Clase online',
                'displayName' => auth()->check()
                    ? $teacher->full_name
                    : 'Estudiante',

                'asigment' => $asigment,
                'teacher' => $teacher,
            ]
        );
    }
}
