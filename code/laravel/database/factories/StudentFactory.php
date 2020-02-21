<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Student::class, function (Faker $faker) {
    return [
        'code' => $faker->postcode,
        'name' => $faker->name,
        'age' => $faker->numberBetween(20,80),
        'gender' => $faker->numberBetween(0,1),
        'email' => $faker->email,
        'address' => $faker->address
    ];
});
