<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ArtistTableSeeder::class);
        $this->call(OriginalSongsTableSeeder::class);
        $this->call(SongsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LikesTableSeeder::class);
    }
}
