<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DiceSeeder::class);
        $this->call(RaceSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
