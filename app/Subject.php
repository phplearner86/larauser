<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
