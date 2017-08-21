<?php

use App\Models\OriginalSong;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginalSongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('original_songs')->insert([
            ['title' => 'I Feel It Coming'],
            ['title' => 'We don\'t talk anymore'],
            ['title' => 'Fake love'],
            ['title' => 'One Dance']
        ]);

        OriginalSong::find(1)->artists()->attach([1,2]);
        OriginalSong::find(2)->artists()->attach([3,4]);
        OriginalSong::find(3)->artists()->attach(5);
        OriginalSong::find(4)->artists()->attach(5);
    }
}
