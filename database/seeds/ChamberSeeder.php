<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChamberSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$chambers = array(
			'chamber_lekarska'       => 'Slovenská lekárska komora',
			'chamber_zubny_l'        => 'Slovenská komora zubných lekárov',
			'chamber_lekarnicka'     => 'Slovenská lekárnická komora',
			'cahmber_sestie'         => 'Slovenská komora sestier a pôrodných asistentiek',
			'chamber_medicine'       => 'Slovenská komora medicínsko-technických pracovníkov',
			'chamber_fyzioterapeuta' => 'Slovenská komora fyzioterapeutov',
			'chamber_zubny_t'        => 'Slovenská komora zubných technikov',
			'chamber_ortoped'        => 'Slovenská komora ortopedických technikov',
			'chamber_zp'             => 'Slovenská komora iných zdravotníckych pracovníkov',
			'chamber_psycholog'      => 'Slovenská komora psychológov',
			'chamber_zz'             => 'Slovenská komora zdravotníckych záchranárov'
		);
		foreach ( $chambers as $key => $chamber ) {
			DB::table( 'settings' )->insert( [
				'name'     => $key,
				'category' => 'chambers',
				'value'    => json_encode( [ 'sk_name' => $chamber ] )
			] );
		}
	}
}
