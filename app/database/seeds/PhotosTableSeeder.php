<?php

class PhotosTableSeeder extends Seeder {

  public function run()
  {
    $Photos = [
        ['caption' => 'Photo One', 'path' => 'img/1.png', 'created_at' => new DateTime, 'updated_at' => new DateTime ],
        ['caption' => 'Photo Two', 'path' => 'img/2.gif', 'created_at' => new DateTime, 'updated_at' => new DateTime ],
    ];

    DB::table('photos')->insert($Photos);
  }

}