<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

    protected $table = 'songs';

    public function originalSong()
    {
        return $this->belongsTo(OriginalSong::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
