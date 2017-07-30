<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{

    protected $table = 'artists';

    public $timestamps = false;

    protected $hidden = [
        'pivot'
    ];

    /**
     * Get the original songs for the artist.
     */
    public function originalSongs()
    {
        return $this->belongsToMany(OriginalSong::class, 'artist_originalsong');
    }
}
