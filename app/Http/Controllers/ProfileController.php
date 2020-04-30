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
        $id = auth()->user()->id;
        $teacher = Teacher::with('address')->findOrFail($id);

        $invitations = $teacher
            ->invitations()
            ->with('asigment')
            ->where('is_acepted', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view()->component(
            'profile',
            ['title' => $teacher->first_name],
            ['teacher' => $teacher, 'invitations' => $invitations]
        );
    }
}
