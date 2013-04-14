<?php

class UsersTableSeeder extends Seeder {

  public function run()
  {
    $Users = [
        
    ];

    DB::table('Users')->insert($Users);
  }

}