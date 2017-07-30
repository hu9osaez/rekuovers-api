<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OriginalSong extends Model {

    protected $table = 'original_songs';

    public $timestamps = false;

    /**
     * Get the artist(s) that owns the original song.
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_originalsong');
    }
}
