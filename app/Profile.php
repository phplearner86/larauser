<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
