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
			$table->string( 'zone' );
			$table->string( 'region' );
			$table->string( 'address' );
			$table->string( 'city' );
			$table->integer( 'zip' );
			$table->json( 'properties' )->nullable();
			$table->boolean( 'verified' )->default( false );
			$table->timestamps();
		} );

		Schema::table( 'surgeries', function ( Blueprint $table ) {
			$table->foreign( 'doctor_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
			$table->unique( [ 'address', 'city', 'zip' ] );
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
