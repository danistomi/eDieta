<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$role_admin              = new Role();
		$role_admin->name        = 'admin';
		$role_admin->description = 'Admin of site';
		$role_admin->save();

		$role_user              = new Role();
		$role_user->name        = 'user';
		$role_user->description = 'A user in site';
		$role_user->save();

		$role_doctor              = new Role();
		$role_doctor->name        = 'doctor';
		$role_doctor->description = 'A doctor in site';
		$role_doctor->save();
	}
}
