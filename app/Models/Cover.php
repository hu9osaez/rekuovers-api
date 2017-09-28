<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'song_id' => 'integer',
        'publisher_id' => 'integer',
        'type' => 'string',
        'youtube_id' => 'string'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'song_id',
        'publisher_id',
        'type',
        'youtube_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'covers';

    /**
     * Return the likes that has the song
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Return the user publisher that belongs the song.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id', 'id');
    }

    /**
     * Return the song that belongs the cover.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo(Song::class, 'song_id', 'id');
    }
}
