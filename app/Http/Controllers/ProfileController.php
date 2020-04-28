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

        return view()->component(
            'profile',
            ['title' => $teacher->first_name],
            ['teacher' => $teacher]
        );
    }
}
