<?php namespace App\Models;

use App\Traits\Uuids;
use App\Transformers\UserTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable implements AuditableContract, Transformable
{
    use Auditable, Notifiable, SoftDeletes, Uuids;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid'        => 'string',
        'name'        => 'string',
        'username'    => 'string',
        'email'       => 'string',
        'facebook_id' => 'string',
        'api_token'   => 'string'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'bio',
        'email',
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'facebook_id',
        'confirmation_code',
        'last_signin_ip',
        'api_token',
        'remember_token',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Return the song that has published the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function covers()
    {
        return $this->hasMany(Cover::class, 'publisher_id', 'id');
    }

    /**
     * Return the likes that the user gave to songs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Mutators
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = app('hash')->make($password);
    }

    public function setUsernameAttribute($username)
    {
        $this->attributes['username'] = strtolower(trim($username));
    }

    public function setEmailAttribute($email)
    {
        // Ensure valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email address.");
        }

        // Ensure email does not exist
        elseif (static::where('email', $email)->count() > 0) {
            throw new \Exception("Email already exists.");
        }

        $this->attributes['email'] = $email;
    }

    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|callable|string|null
     */
    public function transformer()
    {
        return UserTransformer::class;
    }
}
