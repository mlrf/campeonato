<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\models\Player;
use App\models\Club;
use Faker\Generator as Faker;

//$factory->define(Player::class, function (Faker $faker) {
//    return [
//        'name'=>$faker->name,
//
//    ];
//});


$factory->define(Player::class, function (Faker $faker) {
    $clubs = Club::all()->pluck('id');
    return [
        'name'=>$faker->name,
        'shirt_number'=>$faker->numberBetween(0,99),
        'is_injured'=>$faker->randomElement([false,true]),
        'club_id'=>$faker->randomElement($clubs),
        // Rest of attributes...
    ];
});
