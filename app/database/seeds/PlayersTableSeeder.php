<?php

class PlayersTableSeeder extends Seeder {

	public function run()
	{
		$players = [
		
			['lname'      => 'chase', 
			 'fname'      => 'macy', 
			 'position'   => 'pitcher', 
			 'class'      => '2015', 
			 'bats'       => 'right', 
			 'throws'     => 'right', 
			 'number'     => '35', 
			 'created_at' => new DateTime,
			 'updated_at' => new DateTime,
			],

			['lname' => 
			 'ludwigsen', 
			 'fname' => 'kelsi', 
			 'position' => 'catcher', 
			 'class' => '2015', 
			 'bats' => 'right', 
			 'throws' => 'right', 
			 'number' => '8', 
			 'created_at' => new DateTime, 
			 'updated_at' => new DateTime
			],
			
			['lname' => 'clark', 'fname' => 'ciera', 'position' => 'first base', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '27', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'van dyke', 'fname' => 'halei', 'position' => 'second base', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '9', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'lopez', 'fname' => 'aimee', 'position' => 'shortstop', 'class' => '2014', 'bats' => 'right', 'throws' => 'right', 'number' => '2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'parker', 'fname' => 'taylor', 'position' => 'third base', 'class' => '2015', 'bats' => 'left', 'throws' => 'right', 'number' => '16', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'erickson', 'fname' => 'joelle', 'position' => 'outfield', 'class' => '2015', 'bats' => 'left', 'throws' => 'right', 'number' => '36', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'sellona', 'fname' => 'zharde', 'position' => 'outfield', 'class' => '2015', 'bats' => 'left', 'throws' => 'right', 'number' => '5', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'quintanilla', 'fname' => 'natalie', 'position' => 'outfield', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '15', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'bradburn', 'fname' => 'tori', 'position' => 'pitcher', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '3', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'perishoni', 'fname' => 'gina', 'position' => 'outfield', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '1', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'blanca', 'fname' => 'alyssa', 'position' => 'outfield', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '6', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'heflin', 'fname' => 'katie', 'position' => 'first base', 'class' => '2015', 'bats' => 'left', 'throws' => 'right', 'number' => '10', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['lname' => 'tenwolde', 'fname' => 'kristen', 'position' => 'pitcher', 'class' => '2015', 'bats' => 'right', 'throws' => 'right', 'number' => '18', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			
		];

		DB::table('players')->insert($players);
	}

}
