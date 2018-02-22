<?php namespace App\Models;

use App\Traits\Uuids;
use App\Transformers\CoverTransformer;
use Cviebrock\EloquentTaggable\Taggable;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Cover extends Model implements Transformable
{
    use Searchable, Taggable, Uuids;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'song_id' => 'integer',
        'publisher_id' => 'integer',
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
        'youtube_id',
        'description'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'covers';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'likes',
        'publisher',
    ];

    /**
     * Return the likes that has the song
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'cover_id', 'id');
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'youtube_id'  => $this->youtube_id,
            'description' => $this->description
        ];
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'covers_index';
    }

    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|callable|string|null
     */
    public function transformer()
    {
        return CoverTransformer::class;
    }
}
