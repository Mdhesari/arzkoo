<?php

namespace App\Listeners;

use App\Events\AuthenticationAttemptEvent;
use Exception;
use Ghasedak\GhasedakApi;
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
        $mobile = $event->auth->value;
        $password = $event->password;
        $template = 'confirmation';

        try {

            $api = new GhasedakApi(config('ghasedak.api_key'));
            // TODO use default line
            // $result = $api->SendSimple(
            //     $mobile,  // receptor
            //     $message, // message
            //     $line, // choose a line number from your account
            // );

            $api->verify(
                $mobile,
                $type = 1,
                $template,
                $password
            );
        } catch (Exception $e) {

            report($e);
        }
    }
}
