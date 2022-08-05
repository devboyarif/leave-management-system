<?php

namespace App\Http\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactForm extends Component
{
    public $name, $email, $phone, $message;

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function contactFormSubmit()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $contact = ContactMessage::create($validatedDate);
        session()->flash('success', 'Thanks. Your Message Sent.');
        $this->reset();
        $this->emit('created');

        // Mail::to($contact->email)->send(new SendContactFormMail($contact->name, $contact->email, $contact->subject, $contact->message));
    }
}
