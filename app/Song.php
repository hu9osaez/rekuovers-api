<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

    protected $table = 'songs';

    public function originalSong()
    {
        return $this->belongsTo("App\OriginalSong");
    }

    public function likes()
    {
        return $this->hasMany("App\Like");
    }
}
