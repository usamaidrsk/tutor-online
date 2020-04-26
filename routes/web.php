<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/questions/{step}', 'QuestionsController@index')
    ->where('step', '[1,2,3]')
    ->name('questions');

Route::post('/questions/{step}', 'QuestionsController@store')
    ->where('step', '[1,2,3]')
    ->name('questions');

Route::get('/asigment/create', 'AsigmentController@create')->name(
    'asigment.create'
);
Route::get('/asigment/{id}', 'AsigmentController@show')->name('asigment.show');
Route::post('/asigment', 'AsigmentController@store')->name('asigment.store');
