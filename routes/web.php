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

Route::post('/threads/{thread}/replies', 'ReplyController@store')->name('replies.store');
Route::put('/threads/{thread}/replies/{reply}', 'ReplyController@update')->name('replies.update');
Route::delete('/threads/{thread}/replies/{reply}', 'ReplyController@destroy')->name('replies.destroy');

Route::group([
    'middleware' => 'auth',
], function (): void {
    /*
     * User Profile Routes.
     */
    Route::resource('/users', 'Auth\ProfileController', [
        'only' => ['edit', 'update', 'destroy'],
    ]);

    /*
     * User Password Reset Route.
     */
    Route::put(
        '/users/{user}/update/password',
        'Auth\ResetPasswordController@update'
    )->name('users.password');
});
