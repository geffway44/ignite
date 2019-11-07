<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Reply;
use App\Thread;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => function () {
            $user = factory(User::class)->create();
            factory(Profile::class)->create(['user_id' => $user->id]);

            return $user->id;
        },
        'thread_id' => function () {
            return factory(Thread::class)->create()->id;
        },
    ];
});
