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
                'name' => '"I Feel It Coming" Cover // Citizen Føur'
            ],
            [
                'song_id' => 1,
                'youtube_id' => 'qu9V8jhWeYA',
                'name' => 'The Weeknd - I Feel It Coming ( cover by J.Fla )',
            ],
            [
                'song_id' => 1,
                'youtube_id' => '3AMHN0zgTRc',
                'name' => 'I FEEL IT COMING - The Weeknd ft. Daft Punk (Travis Garland Cover)',
            ],
            [
                'song_id' => 4,
                'youtube_id' => 'fiua4M4nw7M',
                'name' => 'One Dance - Drake (William Singe Cover)',
            ],
            [
                'song_id' => null,
                'youtube_id' => 'sxiP9d9c448',
                'name' => 'We Don\'t Talk Anymore | Charlie Puth ft Selena Gomez (Alex G & TJ Brown Loop Pedal Cover)',
            ],
            [
                'song_id' => null,
                'youtube_id' => 'RbctNBlXBJc',
                'name' => 'BTS (방탄소년단) Jimin, JK \'We don\'t talk anymore\'',
            ],
            [
                'song_id' => null,
                'youtube_id' => 'HMulSQgIQCE',
                'name' => 'Dilemma - Nelly | Henry Sax',
            ],
            [
                'song_id' => null,
                'youtube_id' => 'bK9U-WUMql8',
                'name' => 'Marvin Gaye - Charlie Puth - KHS & Tyler & Ryan COVER',
            ],
            [
                'song_id' => null,
                'youtube_id' => '9ygrq7in_uI',
                'name' => 'Charlie Puth - Attention - Cover (Fingerstyle Guitar)',
            ],
            [
                'song_id' => null,
                'youtube_id' => 'fqtt1CfO5oo',
                'name' => 'FILTHY - Justin Timberlake (Travis Garland Cover)',
            ],
            [
                'song_id' => 5,
                'youtube_id' => 'ny9rG50Ve08',
                'name' => 'Privacy - Chris Brown (JamieBoy Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => '9VrXF729ax4',
                'name' => 'JUSTIN TIMBERLAKE - Cry Me A River'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'KUk3WpGo-Q8',
                'name' => 'DO YOU (Acoustic) - Miguel (Travis Garland Cover)'
            ],
        ];

        foreach ($covers as $cover) {
            $nCover = new Cover;
            $nCover->song_id     = $cover['song_id'];
            $nCover->youtube_id  = $cover['youtube_id'];
            $nCover->name = $cover['name'];
            $nCover->save();
        }
    }
}
