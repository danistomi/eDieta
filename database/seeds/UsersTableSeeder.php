<?php

use App\Role;
use App\User;
use App\UserSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

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
		$admin->save();

		$role_admin = Role::where( 'name', 'admin' )->first();
		$admin->roles()->attach( $role_admin );

		$settings                = new UserSettings();
		$settings->site_language = Config::get( 'app.locale' );

		$admin->settings()->save( $settings );


		factory( User::class, 50 )->create()->each( function ( $user ) {
			$role = Role::inRandomOrder()->first();
			/** @var User $user */
			$user->roles()->attach( $role );

			$settings                = new UserSettings();
			$settings->site_language = Config::get( 'app.locales' )[ array_rand( Config::get( 'app.locales' ) ) ];

			$user->settings()->save( $settings );
		} );
	}
}
