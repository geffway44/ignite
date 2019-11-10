<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'website' => $faker->domainName,
        'twitter' => $faker->userName,
        'github' => $faker->userName,
        'job' => $faker->word,
        'hometown' => $faker->city,
        'country' => $faker->country,
        'employment' => $faker->company,
    ];
});
