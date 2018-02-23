<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table( 'users' )->insert( [
			'first_name' => 'Tamás',
			'last_name'  => 'Danis',
			'username'   => 'danistomi',
			'email'      => 'danistomi@gmail.com',
			'password'   => bcrypt( 'asdasd' ),
			'role'       => 'admin'
		] );
		factory( App\User::class, 50 )->create();
	}
}
