<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Artist extends Model implements AuditableContract
{
    use Auditable;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    /**
     * Return the original songs that has the artist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function originalSongs()
    {
        return $this->belongsToMany(OriginalSong::class, 'artist_originalsong');
    }
}
