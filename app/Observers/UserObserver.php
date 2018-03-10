<?php 

namespace App\Observers;

use App\ActivationToken;
use App\User;

class UserObserver
{
     public function creating(User $user)
    {
        $user->slug = User::uniqueNameSlug($user->name);
    }

    public function created(User $user)
    {
        ActivationToken::createNewFor($user);
    }
}