<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(App\Venue::class, function (Faker $faker) {
    return [
        'venue_name' => $faker->name,
        'venue_desc' => Str::random(400),
        'location_id' => 1
    ];
});
