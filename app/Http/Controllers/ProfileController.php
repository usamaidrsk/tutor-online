<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        return view()->component('profile', [
            'title' => auth()->user()->first_name,
        ]);
    }
}
