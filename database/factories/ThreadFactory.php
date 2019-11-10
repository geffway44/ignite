<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Thread;
use App\Channel;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'body' => $faker->paragraph,
        'user_id' => function () {
            $user = factory(User::class)->create();

            factory(Profile::class)->create(['user_id' => $user->id]);

            return $user->id;
        },
        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },
        'slug' => str_slug($title),
        'visits' => 0,
    ];
});
