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
            [
                'song_id' => null,
                'youtube_id' => 'b6fepBtNgVM',
                'name' => 'HAVANA - CAMILA CABELLO (English + Spanish Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => '4ZIZof_N1GY',
                'name' => 'MASK OFF [acoustic] - Future (Travis Garland Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => '5wLXwnNSxHI',
                'name' => 'Dilemma (Remix) - Nelly ft. Kelly Rowland [Lil Crazed ft. Rin from Rin on the Rox]'
            ],
            [
                'song_id' => null,
                'youtube_id' => '5n19hMu4yW0',
                'name' => 'Fix You - Coldplay - Acoustic Cover by Tyler Ward & Boyce Avenue'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'bwnGM_I2WPk',
                'name' => 'Backstreet Boys - I Want It That Way (Boyce Avenue acoustic cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'fvEZUbzqqyM',
                'name' => 'Mirrors - Justin Timberlake (Boyce Avenue feat. Fifth Harmony cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'XfwIargXt28',
                'name' => 'Mirrors- Justin Timberlake (Acoustic Cover) | Gardiner Sisters'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'oHGnhZkELIo',
                'name' => 'Cold - Maroon 5 (Aspen Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'yyXpcA9Cmc8',
                'name' => 'The Weeknd - Starboy (Fabian Wegerer Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'RY_ZDeF9YWQ',
                'name' => 'Closer - The Chainsmokers (ft. Halsey) (William Singe Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'f7_KFk8aUKg',
                'name' => 'Ignition x Don\'t Mind - R. Kelly & Kent Jones (William Singe Mashup Cover)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'vlZ9kjCrGJw',
                'name' => 'ADELE - HELLO (COVER BY LEROY SANCHEZ)'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'rO7oDZZb7K0',
                'name' => 'Hotline Bling by Drake | Cover by Alex Aiono'
            ],
            [
                'song_id' => null,
                'youtube_id' => '7gh1MV0WuO4',
                'name' => 'Love Yourself by Justin Bieber | Cover by Alex Aiono'
            ],
            [
                'song_id' => null,
                'youtube_id' => 'iq9YTSkOr1Y',
                'name' => 'Fake Love - Drake - Cover (fingerstyle guitar)'
            ],
        ];

        foreach ($covers as $cover) {

            $dates = [
                now(),
                now()->subDays(3),
                now()->subDays(rand(1, 8)),
                now()->subWeeks(1),
                now()->subWeeks(rand(1, 5)),
            ];

            $date = array_random($dates);

            $nCover = new Cover;
            $nCover->song_id     = $cover['song_id'];
            $nCover->youtube_id  = $cover['youtube_id'];
            $nCover->name        = $cover['name'];
            $nCover->created_at  = $date;
            $nCover->updated_at  = $date;
            $nCover->save();
        }
    }
}
