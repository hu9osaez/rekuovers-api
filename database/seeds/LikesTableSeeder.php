<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('likes')->truncate();

        for ($i=0; $i < 100; $i++) {
            DB::table('likes')->insert(
                ['song_id' => rand(1, 6), 'user_id' => rand(2, 4)]
            );
        }
    }
}
