<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildVaccinationTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'child_vaccination', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'child_id' )->unsigned();
			$table->integer( 'vaccination_id' )->unsigned();
			$table->boolean( 'done' )->default( false );
			$table->date( 'date' );
			$table->timestamps();
		} );

		Schema::table( 'child_vaccination', function ( Blueprint $table ) {
			$table->foreign( 'child_id' )->references( 'id' )->on( 'children' )->onDelete( 'cascade' );
			$table->foreign( 'vaccination_id' )->references( 'id' )->on( 'vaccinations' )->onDelete( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'child_vaccination' );
	}
}
