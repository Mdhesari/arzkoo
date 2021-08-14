<?php

namespace App\Listeners;

use App\Events\AuthenticationAttemptEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAuthVerificationListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(AuthenticationAttemptEvent $event)
    {
        info('fake sent notif to mobile ' . $event->password);
    }
}
