<?php

use App\Models\Like;
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
        for ($i=0; $i < 100; $i++) {
            Like::create([
                'cover_id' => rand(1, 5),
                'user_id' => rand(2, 4)
            ]);
        }
    }
}
