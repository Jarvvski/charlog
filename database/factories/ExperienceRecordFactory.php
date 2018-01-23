<?php

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

$factory->define(App\Models\ExperienceRecord::class, function (Faker $faker) { 

	return [
        'title' => $faker->sentence($faker->numberBetween(3,5)),
		'source' => implode($faker->paragraphs($faker->numberBetween(2,6))),
		'amount' => $faker->numberBetween(500, 6000),
	];

});