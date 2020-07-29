<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph(4),
        'user_id' => create(User::class),
        'channel_id' => create(Channel::class),
    ];
});
