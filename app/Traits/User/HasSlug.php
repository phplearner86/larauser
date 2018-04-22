<?php 

namespace App\Traits\User;

trait HasSlug
{
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

    protected function getSlug($name)
    {
        $curr_name = $name ?: Auth::user()->name;

        return strtolower($this->name) == strtolower($curr_name) ? $this->slug : static::uniqueNameSlug($curr_name);
    }
}