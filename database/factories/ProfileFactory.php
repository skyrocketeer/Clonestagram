<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
       'title' => $faker->sentence(5),
       'description' => $faker->text(20) 
    ];
});
