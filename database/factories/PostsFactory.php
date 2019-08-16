<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    return [
        'content' => $faker->sentence(40,1),
		'headline' => $faker->sentence(7,1),
		'date' => $faker->date('Y-m-d'),
		'time' => substr($faker->time('G:i'),0,5),
        'ticker_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]),
        'author_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]),
        'typ' => $faker->randomElement(['standard','fussball']),
    ];

});
