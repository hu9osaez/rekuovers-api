<?php

use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            ['title' => 'I Feel It Coming'],
            ['title' => 'We don\'t talk anymore'],
            ['title' => 'Fake love'],
            ['title' => 'One Dance']
        ]);

        Song::find(1)->artists()->attach([1,2]);
        Song::find(2)->artists()->attach([3,4]);
        Song::find(3)->artists()->attach(5);
        Song::find(4)->artists()->attach(5);
    }
}
