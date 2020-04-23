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
