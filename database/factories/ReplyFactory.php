<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(7),
        'thread_id' => create(Thread::class),
        'user_id' => create(User::class),
    ];
});