<?php  

namespace App\Observers;

use App\ActivationToken;

class ActivationTokenObserver{

    public function creating(ActivationToken $token)
    {
        optional($token->user->activationToken)->delete();
    }
}