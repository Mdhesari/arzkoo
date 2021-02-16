<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TicketChatMessage extends Component
{
    /**
     * Message
     *
     * @var \App\Models\TicketMessage
     */
    public $message;

    /**
     * User
     *
     * @var \App\Models\MainUser
     */
    public $user;

    /**
     * Is_reply
     *
     * @var bool
     */
    public $isReply;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $message,
        $user,
        $isReply
    ) {
        $this->message = $message;
        $this->user = $user;
        $this->isReply = $isReply;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ticket-chat-message');
    }
}
