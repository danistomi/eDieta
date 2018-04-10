<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenVaccinationTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'children_vaccination', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'children_id' )->unsigned();
			$table->integer( 'vaccination_id' )->unsigned();
			$table->boolean( 'done' )->default( false );
			$table->date( 'date' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'children_vaccination' );
	}
}
