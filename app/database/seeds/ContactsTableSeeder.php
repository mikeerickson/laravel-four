<?php

class ContactsTableSeeder extends Seeder {

  public function run()
  {
    $Contacts = [
    
    	['fname' => 'mike', 'lname' => 'erickson', 'phone' => '7144544236', 'active' => 1, 'email' => 'mike.erickson@mac.com', 'created_at' => new DateTime, 'updated_at' => new DateTime],
    	['fname' => 'kira', 'lname' => 'erickson', 'phone' => '7149152447', 'active' => 1, 'email' => 'kiraerickson@mac.com', 'created_at' => new DateTime, 'updated_at' => new DateTime],
    	['fname' => 'joelle', 'lname' => 'erickson', 'phone' => '6575551212', 'active' => 1, 'email' => 'joelle.erickson@mac.com', 'created_at' => new DateTime, 'updated_at' => new DateTime],
    	['fname' => 'brady', 'lname' => 'erickson', 'phone' => '7148591309', 'active' => 1, 'email' => 'brady.erickson@mac.com', 'created_at' => new DateTime, 'updated_at' => new DateTime],
    	['fname' => 'bailey', 'lname' => 'erickson', 'phone' => '7145551212', 'active' => 1, 'email' => 'bailey.erickson@mac.com', 'created_at' => new DateTime, 'updated_at' => new DateTime],
    	['fname' => 'trevor', 'lname' => 'erickson', 'phone' => '7148945252', 'active' => 1, 'email' => 'trevor.erickson@mac.com', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        
    ];

    DB::table('contacts')->insert($Contacts);
  }

}