<?php

use Illuminate\Database\Seeder;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('artists')->truncate();
        DB::table('artists')->insert([
            ['name' => 'The Weeknd'],
            ['name' => 'Charlie Puth'],
            ['name' => 'Drake']
        ]);
    }
}
