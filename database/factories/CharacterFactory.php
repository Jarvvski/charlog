<?php

use Faker\Generator as Faker;
use App\Models\Race;

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

$factory->define(App\Models\Character::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'race_id' => Race::inRandomOrder()->first()->id,
        'starting_experience' => $faker->numberBetween(50, 200),
    ];

});
