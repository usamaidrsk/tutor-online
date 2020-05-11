<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/privacy-policy', 'PrivacyPolicyController@index')->name(
    'privacy-policy'
);

Route::get('/room/{token?}', 'RoomController@index')->name('room');

Route::name('invitation.')
    ->prefix('invitation/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/{id}', 'InvitationController@show')->name('show');
        Route::put('/{id}/{answer}', 'InvitationController@update')
            ->name('update')
            ->where('answer', '[0-1]');
    });

Route::name('payment.')
    ->prefix('/payment')
    ->group(function () {
        Route::get('/', 'PaymentController@index')->name('index');
        Route::get('/success', 'PaymentController@success')->name('success');
        Route::post('/create', 'PaymentController@create')->name('create');
        Route::get('/execute', 'PaymentController@execute')->name('execute');
    });

Route::name('teacher.')
    ->prefix('teacher/{id}')
    ->group(function () {
        Route::put('schedule', 'TeachersController@update')->name('schedule');
    });

Route::name('questions')
    ->prefix('questions/{step}')
    ->group(function () {
        Route::get('/', 'QuestionsController@index')->where(
            'step',
            '[1,2,3,4]'
        );
        Route::post('/', 'QuestionsController@store')->where(
            'step',
            '[1,2,3,4]'
        );
    });

Route::name('asigment.')->group(function () {
    Route::get('/my-asigment', 'AsigmentController@index')->name('index');
    Route::put('/my-asigment', 'AsigmentController@update')->name('update');

    Route::get('/new', 'AsigmentController@create')->name('create');
    Route::post('/new', 'AsigmentController@store')->name('store');
});

Route::name('rate.')
    ->prefix('rate/{id}')
    ->group(function () {
        Route::get('/', 'RatesController@index')->name('index');
        Route::post('/', 'RatesController@create')->name('create');
    });
