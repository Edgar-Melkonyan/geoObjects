<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Geometry;
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

$factory->define(Geometry::class, function (Faker $faker) {
    return [
        'type'          => $faker->name,
        'latitude'      => $faker->latitude,
        'longitude'     => $faker->longitude
    ];
});
