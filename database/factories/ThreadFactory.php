<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->paragraph(4),
        'user_id' => create(User::class)->id,
        'channel_id' => create(Channel::class)->id,
    ];
});
