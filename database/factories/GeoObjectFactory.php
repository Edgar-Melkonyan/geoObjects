<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\GeoObject;
use App\Models\Type;
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

$factory->define(GeoObject::class, function (Faker $faker) {
    return [
        'name'          => $faker->name,
        'description'   => $faker->text,
        'area'          => $faker->randomFloat($nbMaxDecimals = 9, $min = 9, $max = 10),
        'type_id'       => factory(Type::class)->create()->id
    ];
});
