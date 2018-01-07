<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RaceSeeder extends Seeder
{

	const RACES = [
		[
			'name' => 'Mortal',
			'health_bonus' => 1
		],
		[
			'name' => 'Bloodwatch',
			'health_bonus' => 1
		],
		[
			'name' => 'Elemental',
			'health_bonus' => 1
		],
		[
			'name' => 'Vampire',
			'health_bonus' => 2
		],
		[
			'name' => 'Werewolf',
			'health_bonus' => 2
		],
		[
			'name' => 'Angel',
			'health_bonus' => 2
		],
		[
			'name' => 'Demon',
			'health_bonus' => 2
		],
		[
			'name' => 'Dragon',
			'health_bonus' => 2
		],
		[
			'name' => 'Undead',
			'health_bonus' => 2
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	foreach(self::RACES as $race) {

	        // insert values
	        DB::table('races')->insert([
	        	'name' => $race['name'],
	        	'health_bonus' => $race['health_bonus'],
	        	'created_at' => Carbon::now()
	        ]);

    	}//END
    }
}
