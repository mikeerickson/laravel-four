<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UserTableSeeder');
		//$this->call('UsersTableSeeder');
		//$this->call('PhotosTableSeeder');
		//$this->call('ContactsTableSeeder');
		//$this->call('CarsTableSeeder');
		//$this->call('PhotosTableSeeder');
		//$this->call('PlayersTableSeeder');
		//$this->call('CompaniesTableSeeder');
		$this->call('DogsTableSeeder');
		$this->call('DogsTableSeeder');
	}

}