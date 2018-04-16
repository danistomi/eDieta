<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurgeriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'surgeries', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'doctor_id' )->unique()->unsigned();
			$table->string( 'name' )->unique();
			$table->string( 'address' )->unique();
			$table->string( 'properties' );
			$table->timestamps();
		} );

		Schema::table( 'surgeries', function ( Blueprint $table ) {
			$table->foreign( 'doctor_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'surgeries' );
	}
}
