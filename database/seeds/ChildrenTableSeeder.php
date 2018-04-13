<?php

use App\Models\Child;
use Illuminate\Database\Seeder;

class ChildrenTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$child = factory( Child::class, 10 )->create();
	}
}
