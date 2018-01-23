<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$admin = User::where('name', 'admin')->first();

		if ($admin) {
			$admin->delete();
		}

		DB::table('users')->insert([
			'name' => 'admin',
			'email' => env('ADMIN_EMAIL', 'admin@charlog.dev'),
			'password' => bcrypt(env('ADMIN_PASSWORD', 'Secret')),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
	}
}
