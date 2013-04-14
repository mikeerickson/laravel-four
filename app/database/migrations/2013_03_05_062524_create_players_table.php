<?php

use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function($table) {
			$table->increments('id');
			$table->string('lname');
			$table->string('fname');
			$table->string('position');
			$table->string('class');
			$table->string('bats');
			$table->string('throws');
			$table->string('number');
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
		Schema::drop('players');
	}

}