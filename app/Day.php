<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withPivot('start', 'end');
    }
}
