<?php

use App\Song;
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
        //DB::table('songs')->truncate();

        Song::create(['original_song_id' => 1, 'type' => 'cover', 'youtube_id' => '-MkrfpSA1ec']);
        Song::create(['original_song_id' => 1, 'type' => 'cover', 'youtube_id' => 'qu9V8jhWeYA']);
        Song::create(['original_song_id' => 1, 'type' => 'cover', 'youtube_id' => '3AMHN0zgTRc']);
        Song::create(['original_song_id' => 2, 'type' => 'remix', 'youtube_id' => 'kwW0IAkwIWc']);
        Song::create(['original_song_id' => 3, 'type' => 'cover', 'youtube_id' => 'rVJVzyR-lCQ']);
    }
}
