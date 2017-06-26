<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'likes';

    public $timestamps = false;

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
