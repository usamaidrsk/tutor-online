<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');

Route::name('questions')
    ->prefix('questions/{step}')
    ->group(function () {
        Route::get('/', 'QuestionsController@index')->where('step', '[1,2,3]');
        Route::post('/', 'QuestionsController@store')->where('step', '[1,2,3]');
    });

Route::name('asigment.')
    ->prefix('asigment')
    ->group(function () {
        Route::get('{id}', 'AsigmentController@show')->name('show');
        Route::get('/', 'AsigmentController@create')->name('create');
        Route::post('/', 'AsigmentController@store')->name('store');
    });

Route::get('/terms', function () {
    return view()->component('terms', [
        'title' => 'Términos y Condiciones',
    ]);
})->name('terms');

Route::get('/privacy-policy', function () {
    return view()->component('privacy-policy', [
        'title' => 'Políticas de Privacidad',
    ]);
})->name('privacy-policy');
