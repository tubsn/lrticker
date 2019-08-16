<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
		'created_at' => $faker->dateTime(),
		'updated_at' => $faker->dateTime(),
        'vorname' => $faker->firstName,
		'nachname' => $faker->lastName,
		'username' => $faker->unique()->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Str::random(20),
        'thumbnail' => $faker->imageUrl(400, 400, 'cats'),
        'description' => $faker->word(3,true),
        'remember_token' => Str::random(10),
    ];
});
