<?php

use App\Models\Cover;
use Illuminate\Database\Seeder;

class CoversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cover::create([
            'song_id' => 1,
            'type' => 'cover',
            'youtube_id' => '-MkrfpSA1ec',
            'description' => ''
        ]);

        Cover::create([
            'song_id' => 1,
            'type' => 'cover',
            'youtube_id' => 'qu9V8jhWeYA',
            'description' => ''
        ]);

        Cover::create([
            'song_id' => 1,
            'type' => 'cover',
            'youtube_id' => '3AMHN0zgTRc',
            'description' => ''
        ]);

        Cover::create([
            'song_id' => 2,
            'type' => 'remix',
            'youtube_id' => 'kwW0IAkwIWc',
            'description' => ''
        ]);

        Cover::create([
            'song_id' => 4,
            'type' => 'cover',
            'youtube_id' => 'g_uYn8AVqeU',
            'description' => ''
        ]);
    }
}
