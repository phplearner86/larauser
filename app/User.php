<?php

namespace App;

use App\ActivationToken;
use App\Observers\UserObserver;
use App\Traits\User\HasSlug;
use App\Traits\User\VerifiesEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasSlug, VerifiesEmail;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function findBy($value, $field='email')
    {
        return static::where($field, $value)->firstOrFail();
    }

    public function accountStatus()
    {
        return $this->verified ? 'active' : 'inactive';
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }

    public static function createAccount($data)
    {
        $user = new static;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();

        $user->roles()->attach($data['role_id']);

        return $user;
    }
   
}
