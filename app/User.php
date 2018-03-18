<?php

namespace App;

use App\ActivationToken;
use App\Observers\UserObserver;
use App\Traits\User\HasSlug;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(UserObserver::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function activationToken()
    {
        return $this->hasOne(ActivationToken::class);
    }

    public function verifyEmail()
    {
        $this->verified = true;
        $this->save();

        $this->activationToken->delete();
    }

    public function isVerified()
    {
        return $this->verified;
    }

    public static function findBy($value, $field='email')
    {
        return static::where($field, $value)->firstOrFail();
    }
   
}
