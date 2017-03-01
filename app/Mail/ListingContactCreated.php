<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\{User};

class ListingContactCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;

    public $message;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $message)
    {
        $this->sender = $sender;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.listing.contact.message');
        ->subject("{$this->sender->name} is applying to become a driver")
        ->('driver@unipool.com')
        ->replyTo($this->sender->email);
    }
}
