<?php

namespace App\Events;

use App\Models\EmailSubscription;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSubmittedNewsletterForm implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newsletter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(EmailSubscription $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
