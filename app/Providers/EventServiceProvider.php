<?php

namespace App\Providers;

use App\Events\AuthenticationAttemptEvent;
use App\Events\NewSubmittedNewsletterForm;
use App\Listeners\SendAuthVerificationListener;
use App\Listeners\SendNewsLetterVerificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
            SendEmailVerificationNotification::class,
        ],
        AuthenticationAttemptEvent::class => [
            SendAuthVerificationListener::class,
        ],
        NewSubmittedNewsletterForm::class => [
            SendNewsLetterVerificationListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
