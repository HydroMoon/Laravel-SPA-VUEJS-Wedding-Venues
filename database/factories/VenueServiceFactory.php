<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\VenueService::class, function (Faker $faker) {
    return [
            'photography' => $faker->boolean(),
            'videography' => $faker->boolean(),
            'organize_team' => $faker->boolean(),
            'overnight' => $faker->boolean(),
            'jirtg' => $faker->boolean(),
            'guests' => $faker->numberBetween(500, 1000)
    ];
});
