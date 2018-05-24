<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientSurgeryTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'patient_surgery', function ( Blueprint $table ) {
			//$table->increments('id');
			$table->integer( 'user_id' )->unsigned();
			$table->integer( 'surgery_id' )->unsigned();
			$table->string( 'verify_code' );
			$table->boolean( 'verified' );
			$table->timestamps();
		} );

		Schema::table( 'patient_surgery', function ( Blueprint $table ) {
			$table->primary( [ 'user_id', 'surgery_id' ] );
			$table->foreign( 'surgery_id' )->references( 'id' )->on( 'surgeries' )->onDelete( 'cascade' );
			$table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'patient_surgery' );
	}
}
