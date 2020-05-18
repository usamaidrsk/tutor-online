<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Asigment;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('profile.index');
        }

        if ($email = Cookie::get('email')) {
            if (Asigment::where('email', $email)->exists()) {
                return redirect()->route('asigment.index');
            }
        }

        return view()->component('home', ['title' => 'Inicio']);
    }
}
