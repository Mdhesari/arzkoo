<?php

namespace App\Http\Livewire;

use App\Events\NewSubmittedNewsletterForm;
use App\Models\EmailSubscription;
use Livewire\Component;

class NewsletterForm extends Component
{
    public $email;

    protected $rules = [
        'email' => ['required', 'email', 'unique:email_subscriptions'],
    ];

    public function submit()
    {
        $this->validate();

        $emailSub = EmailSubscription::create([
            'email' => $this->email,
        ]);

        event(new NewSubmittedNewsletterForm($emailSub));

        $this->emit('newsletterSubmitted');

        $this->fill([
            'email' => '',
        ]);
    }
    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
