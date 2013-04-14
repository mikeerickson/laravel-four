<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	  Schema::create('contacts', function($table)
	  {
	    $table->increments('id');
	    $table->string('fname');
		$table->string('lname');
		$table->string('phone');
		$table->string('email');
		$table->integer('active');
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
	  Schema::drop('contacts');
	}

}