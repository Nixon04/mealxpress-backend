<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalesReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $amount;
    public $reference;

    public $dateissued;
    public $token;


    /**
     * Create a new message instance.
     */
    public function __construct($username, $amount, $reference, $dateissued, $token)
    {
        //
        $this->username = $username;
        $this->amount = $amount;
        $this->reference = $reference;
        $this->dateissued = $dateissued;
        $this->token = $token;
    }

    public function build(){
    return $this->subject('Receipt!')->markdown('emails.salesreceipt');
    }

 

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
