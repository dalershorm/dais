<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Http\Traits\Favoriteability;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable, Favoriteability;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'client_code',
        'password',
        'avatar',
        'direction_id',
        'current_team_id',
        'avatar',
        'is_active',
        'employer',
        'balance',
    ];

    // protected $with = ['builder'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
//        'balance'
    ];

    protected $appends = [
        'allPermissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'integer',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value){

        $this->attributes['password'] = bcrypt($value);
    }

    public function getAllPermissionsAttribute()
    {
        return auth()->user()->employer ? $this->allPermissions() : [];
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
