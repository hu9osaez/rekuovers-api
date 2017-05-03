<?php

use Illuminate\Database\Seeder;

class OriginalSongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('original_songs')->truncate();
        DB::table('original_songs')->insert([
            ['artist_id' => 1, 'title' => 'I Feel It Coming'],
            ['artist_id' => 2, 'title' => 'We don\'t talk anymore'],
            ['artist_id' => 3, 'title' => 'Fake love'],
            ['artist_id' => 3, 'title' => 'One Dance']
        ]);
    }
}
