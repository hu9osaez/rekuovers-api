<?php

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Song::create(['title' => 'I Feel It Coming'])->artists()->attach([1,2]);
        Song::create(['title' => 'We don\'t talk anymore'])->artists()->attach([3,4]);
        Song::create(['title' => 'Fake love'])->artists()->attach(5);
        Song::create(['title' => 'One Dance'])->artists()->attach(5);
        Song::create(['title' => 'Privacy'])->addArtists('Chris Brown');
    }
}
