<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ticker;
use Faker\Generator as Faker;

$factory->define(Ticker::class, function (Faker $faker) {

    return [
        'name' => $faker->sentence(6,1),
		'typ' => $faker->randomElement(['standard','fussball']),
		'start' => $faker->datetime('Y-m-d'),
		'ressort' => $faker->randomElement(['Lokales','Sport', '5vor7']),
		'headline' => $faker->sentence(9,1),
        'posts' => implode(',', $faker->shuffle([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20])),
        'status' => $faker->randomElement([0,1]),
        'author_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]),
    ];

});
