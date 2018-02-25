<?php

use App\Models\Cover;
use App\Models\Like;
use App\Models\User;
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
        $qntLikes = 300;
        $coversCount = Cover::count('id');
        $usersCount = User::count('id');

        for ($i=0; $i < $qntLikes; $i++) {
            $cid = rand(1, $coversCount);
            $uid = rand(1, $usersCount);
            $exists = Like::whereCoverId($cid)->whereUserId($uid)->exists();

            if(!$exists) {
                Like::create([
                    'cover_id' => $cid,
                    'user_id' => $uid
                ]);
            }
        }
    }
}
