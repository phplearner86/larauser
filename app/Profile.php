<?php

namespace App;

use App\Traits\Profile\HasSchedule;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasSchedule;
    
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

    public function days()
    {
        return $this->belongsToMany(Day::class)->as('work')->withPivot('start_at', 'end_at');
    }

    public function hasSchedule()
    {
        return $this->days->count();
    }
}
