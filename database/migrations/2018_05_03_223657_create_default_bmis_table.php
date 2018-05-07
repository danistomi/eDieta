<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultBmisTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'default_bmis', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'age' );
			$table->float( 'bmi' );
			$table->enum( 'gender', [ 'male', 'female' ] );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'default_bmis' );
	}
}
