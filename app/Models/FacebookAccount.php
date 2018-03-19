<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookAccount extends Model
{
    protected $table = 'facebook_accounts';

    protected $fillable = [
        'user_id',
        'user_id_provider',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
