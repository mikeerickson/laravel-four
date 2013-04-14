<?php

class CompaniesTableSeeder extends Seeder {

	public function run()
	{
		$companies = array(

		);

		DB::table('companies')->insert($companies);
	}

}
