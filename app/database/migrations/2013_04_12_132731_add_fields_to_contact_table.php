<?php

use Illuminate\Database\Migrations\Migration;

class AddFieldsToContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contacts', function($table) {
			$table->string('category');			
			$table->string('keywords');			
			$table->timestamp('dob');			
			$table->string('gender');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contacts', function($table) {
			$table->drop_column('category');			
			$table->drop_column('keywords');			
			$table->drop_column('dob');			
			$table->drop_column('gender');						
		});
	}

}