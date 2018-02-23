<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$admin                 = new User();
		$admin->first_name     = 'Tamás';
		$admin->last_name      = 'Danis';
		$admin->username       = 'danistomi';
		$admin->email          = 'danistomi@gmail.com';
		$admin->password       = bcrypt( 'secret' );
		$admin->remember_token = str_random( 10 );
		$admin->save();

		$role_admin = Role::where( 'name', 'admin' )->first();
		$admin->roles()->attach( $role_admin );

		factory( User::class, 50 )->create()->each( function ( $user ) {
			$role = Role::inRandomOrder()->first();
			$user->roles()->attach( $role );
		} );
	}
}
