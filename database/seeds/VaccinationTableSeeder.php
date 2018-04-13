<?php

use App\Models\Vaccination;
use Illuminate\Database\Seeder;

class VaccinationTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	private $datas = [
		[
			'Prva',
			3,
			0,
			'1. dávka (základné očkovanie)',
			'Záškrt, tetanus, čierny kašeľ (acelulárna) Vírusová hepatitída B Invazívne hemofilové infekcie Detská obrna (DTaP-VHB-HIB-IPV) Pneumokokové invazívne ochorenia (konjugovaná vakcína (PCV*), simultánna aplikácia s hexavakcínou)',
			true,
			false
		],
		[
			'Druha',
			5,
			0,
			'2. dávka (základné očkovanie)',
			'Záškrt, tetanus, čierny kašeľ (acelulárna) Vírusová hepatitída B Invazívne hemofilové infekcie Detská obrna (DTaP-VHB-HIB-IPV) Pneumokokové invazívne ochorenia (konjugovaná vakcína (PCV*), simultánna aplikácia s hexavakcínou)',
			true,
			false
		],
		[
			'Tretia',
			11,
			0,
			'3. dávka (základné očkovanie)',
			'Záškrt, tetanus, čierny kašeľ (acelulárna) Vírusová hepatitída B Invazívne hemofilové infekcie Detská obrna (DTaP-VHB-HIB-IPV) Pneumokokové invazívne ochorenia (konjugovaná vakcína (PCV*), simultánna aplikácia s hexavakcínou)',
			true,
			false
		]
	];

	public function run() {
		foreach ( $this->datas as $data ) {
			$vaccination                      = new Vaccination();
			$vaccination->name                = $data[0];
			$vaccination->recommended_min_age = $data[1];
			$vaccination->recommended_max_age = $data[2];
			$vaccination->type                = $data[3];
			$vaccination->immunization        = $data[4];
			$vaccination->recommended         = $data[5];
			$vaccination->recurrent           = $data[6];

			$vaccination->save();
		}
	}
}
