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
	public function up() {
		Schema::create( 'vaccinations', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'child_id' )->unsigned();
			$table->string( 'vaccination_type' );
			$table->date( 'date_of_vaccination' );
			$table->timestamps();
			$table->foreign( 'child_id' )->references( 'id' )->on( 'children' )->onDelete( 'cascade' );
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
