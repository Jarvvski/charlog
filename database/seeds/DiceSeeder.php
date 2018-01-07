<?php

use Illuminate\Database\Seeder;

class DiceSeeder extends Seeder
{


	/**
	 * Constants for seeding
	 */
	
	const MAX_TIER       = 9;
	const DICE_PER_TIER  = 10;
	const XP_INCREMENTS  = [
		250, // tier 1
		500, // tier 2
		750, // tier 3
		1000, // tier 4
		2500, // tier 5
		5000, // tier 6
		10000, // tier 7
		50000, // tier 8
	];


	const XP_INCREMENT_MAGIC_BULLSHIT       = 94;
	const XP_INCREMENT_MAGIC_BULLSHIT_VALUE = 100000;
	const STARTING_TIER                     = 1;
	const STARTING_XP                       = 0;
	const STARTING_DICE                     = 20;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	

		// setup starting loop values
		$xp   = self::STARTING_XP;
		$dice = self::STARTING_DICE;

		for ($tier = self::STARTING_TIER; $tier < self::MAX_TIER; $tier++) {

			// $j is for looping through each tier's dice
			for ($j = 0; $j < self::DICE_PER_TIER; $j++) {

				// insert values
				DB::table('dice_index')->insert([
					'dice_sides' => $dice++,
					'tier' => $tier,
					'experience_required' => $xp
				]);

				// this is fucked up. Why change a system so randomly?
				if ($dice > self::XP_INCREMENT_MAGIC_BULLSHIT) {
					$xp = $xp + self::XP_INCREMENT_MAGIC_BULLSHIT_VALUE; 
				} else {
					$xp = $xp + self::XP_INCREMENTS[$tier-1];
				}

			}//END
			
		}//END
		
	}
}
