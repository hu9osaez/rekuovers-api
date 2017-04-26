<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

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
        Schema::disableForeignKeyConstraints();

        $this->call(ArtistTableSeeder::class);
        $this->call(OriginalSongsTableSeeder::class);
        $this->call(SongsTableSeeder::class);
        $this->call(LikesTableSeeder::class);

        Model::reguard();
        Schema::enableForeignKeyConstraints();
    }
}
