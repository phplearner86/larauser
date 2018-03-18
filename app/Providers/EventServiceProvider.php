<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            'App\Listeners\Auth\ActivateAccount@sendActivationToken',
        ],
          'App\Events\Auth\EmailVerified' => [
            'App\Listeners\Auth\ActivateAccount@sendThankYouNote',
        ],

        'App\Events\Auth\TokenRequested' => [
            'App\Listeners\Auth\ActivateAccount@resendActivationToken',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
