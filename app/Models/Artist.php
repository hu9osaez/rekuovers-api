<?php namespace App\Models;

use App\Traits\Uuids;
use App\Transformers\ArtistTransformer;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model implements Transformable
{
    use Sluggable, SluggableScopeHelpers, Uuids;

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
     * Return the songs that has the artist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'artist_song');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|callable|string|null
     */
    public function transformer()
    {
        return ArtistTransformer::class;
    }
}
