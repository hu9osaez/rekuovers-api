<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ArtistTableSeeder::class);
        $this->call(SongsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CoversTableSeeder::class);
        //$this->call(LikesTableSeeder::class);
    }
}
