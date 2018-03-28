<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function createNew($data)
    {
        $role = new static;

        $role->name = $data['name'];

        $role->save();
    }
}
