<?php

use Illuminate\Database\Seeder;
use App\Models\Character;

class DemoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Models\Character::class, 20)->create();


		factory(App\Models\ExperienceRecord::class, 30)->create()->each(function ($r) {
			$characters = Character::inRandomOrder()->limit(3)->get();
			$r->characters()->attach($characters);
		});

	}

}
