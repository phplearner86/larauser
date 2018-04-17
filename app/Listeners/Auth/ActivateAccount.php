<?php

namespace App\Listeners\Auth;

use App\Events\Auth\AccountCreatedByAdmin;
use App\Events\Auth\EmailVerified;
use App\Events\Auth\TokenRequested;
use App\Mail\Auth\PleaseActivateYourAccount;
use App\Mail\Auth\PleaseConfirmYourEmailAddress;
use App\Mail\Auth\ThankiYouForRegisteringWithUs;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ActivateAccount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function sendActivationToken(Registered $event)
    {
        Mail::to($event->user)->send(new PleaseConfirmYourEmailAddress($event->user->activationToken));
    }

    public function sendThankYouNote(EmailVerified $event)
    {
        Mail::to($event->user)->send(new ThankiYouForRegisteringWithUs($event->user));
    }

    public function resendActivationToken(TokenRequested $event)
    {
        Mail::to($event->user)->send(new PleaseConfirmYourEmailAddress($event->user->activationToken));
    }

    public function sendTokenAndPassword(AccountCreatedByAdmin $event)
    {
        Mail::to($event->user)->send(new PleaseActivateYourAccount($event->user->activationToken, $event->password));
    }
}
