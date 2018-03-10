<?php

namespace App;

use App\Observers\UserObserver;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(UserObserver::class);
    }

     /**
     * Generate the unique name slug.
     *
     * @param  string $name
     * @return string
     */
    public static function uniqueNameSlug($name)
    {
        $slug = str_slug($name);

        if (static::nameSlugExists($slug))
        {

            $pieces = explode('-', static::nameSlugLatest($slug));

            $number = intval(end($pieces));

            $slug .= '-' .($number + 1);
        }

        return $slug;
    }

    /**
     * Determine if the name slug exists.
     *
     * @param  string $slug
     * @return boolean
     */
    protected static function nameSlugExists($slug)
    {
        return (bool) static::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
    }

    /**
     * Fetch the latest user.
     * @param  string $slug
     * @return App\Slug
     */
    protected static function nameSlugLatest($slug)
    {
        return static::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")
                ->latest('slug', 'desc')
                ->pluck('slug')
                ->first();
    }
   
}
