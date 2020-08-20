<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->word,
        'slug' => Str::slug($name),
        'description' => $faker->paragraph(4),
        'archived' => false,
        'color' => $faker->hexColor,
    ];
});
