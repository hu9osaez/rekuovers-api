<?php

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
        DB::table('songs')->insert([
            ['original_song_id' => 1, 'type' => 'cover', 'youtube_id' => '-MkrfpSA1ec', 'created_at' => \Carbon\Carbon::now()],
            ['original_song_id' => 1, 'type' => 'cover', 'youtube_id' => 'qu9V8jhWeYA', 'created_at' => \Carbon\Carbon::now()],
            ['original_song_id' => 1, 'type' => 'cover', 'youtube_id' => '3AMHN0zgTRc', 'created_at' => \Carbon\Carbon::now()],
            ['original_song_id' => 2, 'type' => 'remix', 'youtube_id' => 'kwW0IAkwIWc', 'created_at' => \Carbon\Carbon::now()],
            ['original_song_id' => 3, 'type' => 'cover', 'youtube_id' => 'rVJVzyR-lCQ', 'created_at' => \Carbon\Carbon::now()],
            ['original_song_id' => 4, 'type' => 'cover', 'youtube_id' => 'g_uYn8AVqeU', 'created_at' => \Carbon\Carbon::now()]
        ]);
    }
}
