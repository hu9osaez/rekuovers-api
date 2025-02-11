<?php namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Uuid::uuid4()->toString();
            }
        });

        static::saving(function ($model) {
            $original_uuid = $model->getOriginal('uuid');

            if ($original_uuid !== $model->uuid) {
                $model->uuid = $original_uuid;
            }
        });
    }

    /**
     * Scope By UUID
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $uuid
     *
     * @return mixed
     */
    public function scopeByUuid($query, $uuid, $first = true)
    {
        $match = preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uuid);

        if (!is_string($uuid) || $match !== 1) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        $results = $query->where('uuid', $uuid);

        return $first ? $results->first() : $results;
    }
}
