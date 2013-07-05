<?php

class DogsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	// DB::table('dogs')->delete();

        $dogs = array(
        	array('name' => 'Shilo', 'gender' => 'female', 'age' => 9, 'created_at' => new DateTime, 'updated_at' => new DateTime),
        	array('name' => 'Honu', 'gender' => 'male', 'age' => 4, 'created_at' => new DateTime, 'updated_at' => new DateTime),
        	array('name' => 'Gunner', 'gender' => 'male', 'age' => 3, 'created_at' => new DateTime, 'updated_at' => new DateTime),
        	array('name' => 'Rupert', 'gender' => 'male', 'age' => 9, 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );

        // Uncomment the below to run the seeder
        DB::table('dogs')->insert($dogs);
    }

}