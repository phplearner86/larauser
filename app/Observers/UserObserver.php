<?php 

namespace App\Observers;

use App\User;

class UserObserver
{
     public function creating(User $user)
    {
        $user->slug = User::uniqueNameSlug($user->name);
    }
}