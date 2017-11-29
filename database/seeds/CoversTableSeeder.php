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
        $covers = [
            [
                'song_id' => 1,
                'youtube_id' => '-MkrfpSA1ec',
                'tags' => [
                    'Boy Band',
                    'Street'
                ]
            ],
            [
                'song_id' => 1,
                'youtube_id' => 'qu9V8jhWeYA',
                'tags' => [
                    'Oriental'
                ]
            ],
            [
                'song_id' => 1,
                'youtube_id' => '3AMHN0zgTRc',
                'tags' => [
                    'Boy'
                ]
            ],
            [
                'song_id' => 4,
                'youtube_id' => 'fiua4M4nw7M',
                'tags' => [
                    'Boy',
                    'Piano'
                ]
            ]
        ];

        foreach ($covers as $cover) {
            $nCover = new Cover;
            $nCover->song_id    = $cover['song_id'];
            $nCover->youtube_id = $cover['youtube_id'];
            $nCover->save();

            $nCover->tag($cover['tags']);
        }
    }
}
