<?php

namespace App\Listeners\Auth;

use App\Events\Auth\EmailVerified;
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
}
