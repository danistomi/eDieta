<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->call( RoleTableSeeder::class );
		$this->call( UsersTableSeeder::class );
		$this->call( VaccinationTableSeeder::class );
		$this->call( ChildrenTableSeeder::class );
		$this->call( BmiTableSeeder::class );
		$this->call( ChamberSeeder::class );
	}
}
