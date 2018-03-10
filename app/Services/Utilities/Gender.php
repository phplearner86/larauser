<?php 

namespace App\Services\Utilities;

class Gender {

    protected static $options = [
        1 => 'Male',
        2 => 'Female'
    ];

    public static function all()
    {
        return static::$options;
    }
}