<?php

use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	  Schema::create('cars', function($table)
	  {
	    $table->increments('id');
	    $table->string('model');
		$table->string('make');
		$table->integer('year');
	    $table->timestamps();
	  });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	  Schema::drop('cars');
	}

}