<?php

namespace App;

use App\ActivationToken;
use App\Observers\UserObserver;
use App\Profile;
use App\Role;
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

    public function profile()
    {
        return $this->hasOne(Profile::class);
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

    public function updateAccount($data)
    {
        $slug = $this->getSlug($data['name']);

        $this->name = $data['name'];
        $this->slug = $slug;
        $this->email = $data['email'];
        $this->password = bcrypt($data['password']);
        $this->roles()->sync($data['role_id']);

        $this->save();
    }

    public function revokeRoles($roleId)
    {

        $roles = Role::whereIn('id', $roleId)->get();

        $this->roles()->detach($roles);
    }

    public function createOrUpdateProfile($data)
    {

        $profile = $this->profile ?: new Profile();

        
        if ($data->name) 
        {
            $profile->name = $data->name;
        }

        $this->profile()->save($profile);

        if ($subjects = $data['subject_id']) 
        {
            $profile->subjects()->attach($subjects);
        }

        return $profile;
    }

    
   
}
