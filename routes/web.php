<?php

use Illuminate\Support\Facades\Route;

/*
 * Landing Page...
 */
Route::get('/', function () {
    return 'Landing page';
});

/*
 * User Authentication Routes...
 */
Auth::routes();

/*
 * Threads Resource Routes...
 */
Route::group([
    'middleware' => 'auth',
], function (): void {
    Route::resource('/threads', 'ThreadController');
});
