<?php

use App\Models\Role;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$admin             = new User();
		$admin->first_name = 'Tamás';
		$admin->last_name  = 'Danis';
		$admin->username   = 'danistomi';
		$admin->email      = 'danistomi@gmail.com';
		$admin->verified   = true;
		$admin->password   = bcrypt( 'secret' );
		$admin->save();

		$role_admin = Role::where( 'name', 'admin' )->first();
		$admin->roles()->attach( $role_admin );

		$settings                = new UserSettings();
		$settings->site_language = Config::get( 'app.locale' );

		$admin->settings()->save( $settings );


		factory( User::class, 50 )->create()->each( function ( User $user ) {
			$role = Role::where( 'name', 'user' )->first();
			$user->roles()->attach( $role );

			$settings = new UserSettings();
			if ( Config::get( 'app.default_locale' ) == '' ) {
				//$settings->site_language = Session::has( 'applocale' ) ? Session::get( 'applocale' ) : Config::get( 'app.fallback_locale' );
				$settings->site_language = Config::get( 'app.locales' )[ array_rand( Config::get( 'app.locales' ) ) ];
			} else {
				$settings->site_language = Config::get( 'app.locale' );
			}

			$user->settings()->save( $settings );
		} );
	}
}
