<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model {

    protected $table = 'artists';

    public $timestamps = false;

    /**
     * Get the original songs for the artist.
     */
    public function originalSongs()
    {
        return $this->hasMany("App\OriginalSong");
    }
}
