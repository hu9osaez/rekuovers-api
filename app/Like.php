<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'likes';

    public $timestamps = false;

    public function song()
    {
        return $this->belongsTo("App\Song");
    }
}
