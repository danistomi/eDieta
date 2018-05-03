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
		$child                = new Child();
		$child->parent_id     = 1;
		$child->first_name    = "Balazs";
		$child->last_name     = "Danis";
		$child->date_of_birth = '2016-07-20';
		$child->gender        = 'male';
		$child->save();

		$child = factory( Child::class, 9 )->create();
	}
}
