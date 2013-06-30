<?php

use Illuminate\Database\Migrations\Migration;

class AddAddressToCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('companies', function($table) {
			$table->string('address');			
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
			$table->drop_column('address');			
		});
	}

}