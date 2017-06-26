<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OriginalSong extends Model {

    protected $table = 'original_songs';

    public $timestamps = false;

    /**
     * Get the artist that owns the original song.
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
