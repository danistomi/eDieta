<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultVaccinationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'default_vaccinations', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->integer( 'recommended_min_month' );
			$table->integer( 'recommended_max_month' );
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
		Schema::dropIfExists( 'default_vaccinations' );
	}
}
