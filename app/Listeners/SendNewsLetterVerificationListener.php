<?php

namespace App\Listeners;

use App\Events\NewSubmittedNewsletterForm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewsLetterVerificationListener implements ShouldQueue
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
     * @param NewSubmittedNewsletterForm $event
     * @return void
     */
    public function handle(NewSubmittedNewsletterForm $event)
    {
        $event->newsletter->sendNewsLetterNotification();
    }
}
