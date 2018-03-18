<?php

namespace App;

use App\Observers\ActivationTokenObserver;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivationToken extends Model
{
    protected $dates = ['expires_at'];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        static::observe(ActivationTokenObserver::class);
    }

    public  function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createNewFor($user)
    {
        $token = new static;

        $token->user_id = $user->id; 
        $token->token = str_limit(md5(($user->email). str_random()), 32);
        $token->expires_at = Carbon::today()->addWeeks(2);
        
        $token->save();
    }

    public function hasExpired()
    {
        return Carbon::today()->gt($this->expires_at);
    }
}
