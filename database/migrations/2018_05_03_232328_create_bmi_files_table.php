<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBmiFilesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'bmi_files', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'file_name' );
			$table->string( 'storage_file_name' );
			$table->enum( 'gender', [ 'male', 'female' ] );
			$table->boolean( 'in_use' )->default( false );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'bmi_files' );
	}
}
