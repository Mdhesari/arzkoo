<?php

namespace App\Http\Livewire;

use App\Events\NewSubmittedContactForm;
use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $message;

    protected $rules = [
        'name' => ['required', 'min:3'],
        'email' => ['required', 'email'],
        'mobile' => ['required'],
        'message' => ['min: 8']
    ];

    public function submit()
    {
        $this->validate();

        $contact = Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'message' => $this->message,
        ]);

        event(new NewSubmittedContactForm($contact));

        $this->emit('contactSubmitted');

        $this->fill([
            'name' => '',
            'email' => '',
            'mobile' => '',
            'message' => '',
        ]);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
