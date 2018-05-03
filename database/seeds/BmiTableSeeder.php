<?php

use App\Models\Bmi;
use Illuminate\Database\Seeder;

class BmiTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$c = 1;
		for ( $i = 50; $i < 150; $i += 5 ) {
			$bmi           = new Bmi();
			$bmi->child_id = 1;
			$bmi->weight   = $i * 0.1;
			$bmi->height   = 50 + $i * 0.2;
			$bmi->updateBmi();
			$date            = new DateTime();
			$bmi->created_at = date_sub( $date, date_interval_create_from_date_string( $c . ' months' ) );
			$bmi->save();
			$c ++;
		}
	}
}
