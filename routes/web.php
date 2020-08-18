<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('threads.create');
});

/*
 * Landing Page...
 */
Route::get('/', 'GeneralPagesController@index');

/*
 * User Authentication Routes...
 */
Auth::routes();

/*
 * Threads Resource Routes...
 */
Route::resource('/threads', 'ThreadController');

Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
