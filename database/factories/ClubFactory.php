<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\models\Club;
use Faker\Generator as Faker;

$factory->define(Club::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'address'=>$faker->address,
        'vat'=>$faker->numberBetween(0,999999999)
    ];
});
