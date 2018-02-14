<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create( 'children', function ( Blueprint $table ) {
	    	$table->increments('id');
	    	$table->integer('parent_id')->unsigned();
	    	$table->string('first_name');
	    	$table->string('last_name');
	    	$table->date('date_of_birth');
	    	$table->enum('gender', ['male', 'female']);
		    $table->timestamps();
		    $table->foreign( 'parent_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

	    Schema::dropIfExists( 'children' );
    }
}
