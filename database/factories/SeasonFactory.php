<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\models\Season;
use Faker\Generator as Faker;

$factory->define(Season::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
