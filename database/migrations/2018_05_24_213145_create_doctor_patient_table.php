<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorPatientTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'doctor_patient', function ( Blueprint $table ) {
			$table->integer( 'user_id' )->unsigned();
			$table->integer( 'doctor_id' )->unsigned();
			$table->string( 'verify_code' );
			$table->boolean( 'verified' )->default( false );
			$table->timestamps();
		} );

		Schema::table( 'doctor_patient', function ( Blueprint $table ) {
			$table->primary( [ 'user_id', 'doctor_id' ] );
			$table->foreign( 'doctor_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
			$table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'doctor_patient' );
	}
}









