<?php

namespace App\Models;

use App\Models\Configurations;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{

    use HasApiTokens, Notifiable;
    use Cachable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password' ,'remember_token',
    ];

    public function configurations()
    {
        return $this->hasMany('App\Models\Configurations');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeIdentifier($query, $id)
    {
        return $query->where('provider_id', '=', $id);
    }

    public function scopeAccountName($query, $name)
    {
        return $query->where('provider', '=', $name);
    }

}