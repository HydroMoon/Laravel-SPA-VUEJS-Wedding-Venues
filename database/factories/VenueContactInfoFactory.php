<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\ContactInfo::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone1' => 789789,
        'email' => $faker->unique()->safeEmail
    ];
});
