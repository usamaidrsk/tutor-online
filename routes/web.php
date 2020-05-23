<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')
    ->middleware('guest')
    ->name('home');

Route::name('dashboard.')
    ->prefix('/dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
        Route::get('/edit', 'DashboardController@edit')->name('edit');
        Route::put('/edit', 'DashboardController@update')->name('update');
    });

Route::name('asigment.')
    ->middleware('is:student')
    ->group(function () {
        Route::get('/new', 'AsigmentController@create')->name('create');
        Route::post('/new', 'AsigmentController@store')->name('store');

        Route::prefix('/asigment/{id}')
            ->middleware('owns:student,asigment')
            ->group(function () {
                Route::get('/', 'AsigmentController@index')->name('index');
                Route::put('/', 'AsigmentController@update')->name('update');
                Route::delete('/', 'AsigmentController@delete')->name('delete');
            });
    });

Route::prefix('/asigment/{id}/checkout')
    ->middleware('is:student')
    ->group(function () {
        Route::get('/', 'CheckoutController@index')->name('checkout.index');
        Route::get('/success', 'CheckoutController@success')->name(
            'checkout.success'
        );
        Route::post('/create', 'CheckoutController@prepare')->name(
            'payment.create'
        );
        Route::get('/execute', 'CheckoutController@execute')->name(
            'payment.execute'
        );
    });

Route::get('/asigment/{id}/room', 'RoomController@index')
    ->middleware('auth')
    ->name('room');

Route::name('invitation.')
    ->prefix('/invitation')
    ->middleware('is:teacher', 'owns:teacher,invitation')
    ->group(function () {
        Route::get('/{id}', 'InvitationController@show')->name('show');
        Route::put('/{id}/{answer}', 'InvitationController@update')
            ->name('update')
            ->where('answer', '[0-1]');
    });

Route::name('choose-account-type')
    ->prefix('/choose-account-type')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'ChooseAccountTypeController@index');
        Route::post('/', 'ChooseAccountTypeController@decide');
    });

Route::name('questions')
    ->prefix('questions/{step}')
    ->middleware('is:teacher')
    ->group(function () {
        Route::get('/', 'QuestionsController@index')->where('step', '[1-4]');
        Route::post('/', 'QuestionsController@store')->where('step', '[1-4]');
    });

Route::name('rate.')
    ->prefix('rate/{id}')
    ->middleware('is:student')
    ->group(function () {
        Route::get('/', 'RatesController@index')->name('index');
        Route::post('/', 'RatesController@create')->name('create');
    });

Route::name('teacher.')
    ->prefix('teacher/{id}')
    ->group(function () {
        Route::put('schedule', 'TeachersController@update')->name('schedule');
    });

Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/privacy-policy', 'PrivacyPolicyController@index')->name(
    'privacy-policy'
);
