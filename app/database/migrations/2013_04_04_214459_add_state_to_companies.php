<?php

use Illuminate\Database\Migrations\Migration;

class AddStateToCompanies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('companies', function($table) {
			$table->string('state');			
			$table->string('zip');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('companies', function($table) {
			$table->drop_column('state');			
			$table->drop_column('zip');			
		});
	}

}