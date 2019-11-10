<?php

/*
 * Landing Page...
 */
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

/*
 * Auth Routes...
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'middleware' => 'auth',
], function () {
    /*
     * Channels Routes...
     */
    Route::get('/channels', 'ChannelController@index')->name('channels.index');

    /*
     * Threads Routes...
     */
    Route::get('/threads/search', 'SearchController@search')->name('threads.search');
    Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
    Route::post('/threads', 'ThreadController@store')->name('threads.store');
    Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
    Route::put('/threads/{channel}/{thread}/update', 'ThreadController@update')->name('threads.update');
    Route::delete('/threads/{channel}/{thread}/delete', 'ThreadController@destroy')->name('threads.destroy');
    Route::post('/threads/{channel}/{thread}/subscribe', 'ThreadSubscriptionController@subscribe')->name('threads.subscribe');
    Route::delete('/threads/{channel}/{thread}/unsubscribe', 'ThreadSubscriptionController@unsubscribe')->name('threads.unsubscribe');
    Route::get('/threads/{channel?}', 'ThreadController@index')->name('threads.index');

    /*
     * Replies Routes...
     */
    Route::get('/threads/{channel}/{thread}/replies', 'ReplyController@index')->name('replies.show');
    Route::post('/threads/{channel}/{thread}', 'ReplyController@store')->name('replies.store');
    Route::post('replies/{reply}/favorite', 'FavoriteController@favorite')->name('replies.favorite');
    Route::delete('replies/{reply}/unfavorite', 'FavoriteController@unfavorite')->name('replies.unfavorite');
    Route::put('replies/{reply}/update', 'ReplyController@update')->name('replies.update');
    Route::delete('replies/{reply}/destroy', 'ReplyController@destroy')->name('replies.destroy');

    /*
     * Users Routes...
     */
    Route::get('/user/{user}', 'Auth\ProfileController@show')->name('user.show');
    Route::get('/user/{user}/notifications', 'Auth\NotificationController@index')->name('user.notifications');
    Route::delete('/user/{user}/notifications/{notification}', 'Auth\NotificationController@destroy')->name('user.notifications.destroy');
    Route::get('/user/{user}/edit', 'Auth\AccountController@edit')->name('user.edit');
    Route::put('/user/{user}/update', 'Auth\AccountController@update')->name('user.update');
    Route::get('/user/{user}/destroy', 'Auth\ProfileController@destroy')->name('user.destroy');
    Route::delete('/user/{user}/destroy', 'Auth\AccountController@destroy')->name('user.destroy');
    Route::put('/user/{user}/password/update', 'Auth\PasswordController@update')->name('user.password.update');
    Route::post('/user/{user}/avatar', 'Auth\AvatarController@store')->name('user.avatar');
    Route::delete('/user/{user}/avatar/delete', 'Auth\AvatarController@destory')->name('user.avatar.destroy');
});

/*
 * API Routes...
 */
Route::get('/api/users', 'Api\UserController@index')->name('users');

/*
 * Admin Routes...
 */
Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin.index');
});

/*
 * Common Routes...
 */
Route::get('/help', function () {
    return view('help');
});
