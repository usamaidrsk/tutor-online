<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/post-registration', function () {
    return view()->component(
        'postregistration',
        ['title' => 'Cosas sobre ti'],
        [
            'countries' => DB::table('countries')->get(),
            'categories' => DB::table('categories')->get(),
            'levels' => DB::table('levels')->get(),
        ]
    );
})
    ->name('post-registration')
    ->middleware('auth');
