<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/privacy-policy', 'PrivacyPolicyController@index')->name(
    'privacy-policy'
);

Route::get('/room/{id}', 'RoomController@index')->name('room');

Route::put('invitations/{id}/{answer}', 'InvitationController@update')
    ->name('invitation.update')
    ->where('answer', '[0-1]');

Route::name('questions')
    ->prefix('questions/{step}')
    ->group(function () {
        Route::get('/', 'QuestionsController@index')->where('step', '[1,2,3]');
        Route::post('/', 'QuestionsController@store')->where('step', '[1,2,3]');
    });

Route::name('asigment.')->group(function () {
    Route::get('/new', 'AsigmentController@create')->name('create');
    Route::get('show/{id}', 'AsigmentController@review')
        ->middleware('auth')
        ->name('review');
    Route::get('{id}', 'AsigmentController@show')->name('show');
    Route::post('/new', 'AsigmentController@store')->name('store');
    Route::put('/{id}', 'AsigmentController@update')->name('update');
});

Route::name('rate.')
    ->prefix('rate/{id}')
    ->group(function () {
        Route::get('/', 'RatesController@index')->name('index');
        Route::post('/', 'RatesController@create')->name('create');
    });
