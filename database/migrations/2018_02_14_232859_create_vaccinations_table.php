<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccinationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
//	public function up() {
//		Schema::create( 'vaccinations', function ( Blueprint $table ) {
//			$table->increments( 'id' );
//			$table->integer( 'child_id' )->unsigned();
//			$table->string( 'vaccination_type' );
//			$table->date( 'date_of_vaccination' );
//			$table->timestamps();
//			$table->foreign( 'child_id' )->references( 'id' )->on( 'children' )->onDelete( 'cascade' );
//		} );
//	}
	public function up() {
		Schema::create( 'vaccinations', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->integer( 'recommended_min_age' )->unsigned();
			$table->integer( 'recommended_max_age' )->unsigned()->nullable();
			$table->string( 'type' );
			$table->string( 'immunization' );
			$table->boolean( 'recommended' );
			$table->boolean( 'recurrent' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIFExists( 'vacations' );
		Schema::dropIfExists( 'vaccinations' );
	}
}
