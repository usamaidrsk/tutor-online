<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use DB;

class RatesController extends Controller
{
    public function index($id)
    {
        if (auth()->check()) {
            return redirect()->route('profile');
        }

        return view()->component(
            'rate',
            ['title' => 'Puntuar clase'],
            [
                'teacher' => Teacher::findOrFail($id),
                'criterias' => DB::table('criterias')->get(),
            ]
        );
    }

    public function create($id)
    {
        return DB::table('rates')->insert(request()->rates);
    }
}
