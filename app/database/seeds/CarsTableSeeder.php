<?php

class CarsTableSeeder extends Seeder {

  public function run()
  {
    $Cars = [
      [ 'make' => 'Ford', 'model' => 'Excursion', 'year' => 2001, 'created_at' => new DateTime, 'updated_at' => new DateTime ],
      [ 'make' => 'Volkswagon', 'model' => 'Golf', 'year' => 2000, 'created_at' => new DateTime, 'updated_at' => new DateTime ],
      [ 'make' => 'BMW', 'model' => '328i', 'year' => 1985, 'created_at' => new DateTime, 'updated_at' => new DateTime ]  
    ];

    DB::table('cars')->insert($Cars);
  }

}