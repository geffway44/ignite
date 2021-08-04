<?php

use App\Http\Controllers\ReplyController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:scorch', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Dashboard/Home'))->name('home');

    Route::get('threads', [ThreadController::class, 'index'])->name('threads');
    Route::get('thread/{thread}', [ThreadController::class, 'show'])->name('threads.show');
    Route::get('threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::get('threads/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.delete');

    Route::post('replies', [ReplyController::class, 'store'])->name('replies.store');
});
