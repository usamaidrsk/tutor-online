<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;

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
            'profile',
            ['title' => $teacher->first_name],
            [
                'teacher' => $teacher,
                'invitations' => $invitations,
                'rooms' => $rooms,
            ]
        );
    }
}
