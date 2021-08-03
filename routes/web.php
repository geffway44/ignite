<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:scorch', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Dashboard/Home'))->name('home');
});

Route::get('threads', [ThreadController::class, 'index']);
Route::post('threads/create', [ThreadController::class, 'store']);
Route::put('threads/{thread}',[ThreadController::class, 'update']);
