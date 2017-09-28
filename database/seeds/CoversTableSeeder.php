<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('covers')->insert([
            ['song_id' => 1, 'type' => 'cover', 'youtube_id' => '-MkrfpSA1ec', 'created_at' => Carbon::now()],
            ['song_id' => 1, 'type' => 'cover', 'youtube_id' => 'qu9V8jhWeYA', 'created_at' => Carbon::now()],
            ['song_id' => 1, 'type' => 'cover', 'youtube_id' => '3AMHN0zgTRc', 'created_at' => Carbon::now()],
            ['song_id' => 2, 'type' => 'remix', 'youtube_id' => 'kwW0IAkwIWc', 'created_at' => Carbon::now()],
            ['song_id' => 3, 'type' => 'cover', 'youtube_id' => 'rVJVzyR-lCQ', 'created_at' => Carbon::now()],
            ['song_id' => 4, 'type' => 'cover', 'youtube_id' => 'g_uYn8AVqeU', 'created_at' => Carbon::now()]
        ]);
    }
}
