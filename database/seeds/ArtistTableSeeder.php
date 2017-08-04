<?php

use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::create(['name' => 'The Weeknd']);
        Artist::create(['name' => 'Daft Punk']);
        Artist::create(['name' => 'Charlie Puth']);
        Artist::create(['name' => 'Selena Gomez']);
        Artist::create(['name' => 'Drake']);
    }
}
