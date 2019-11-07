<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->sentence,
    ];
});
