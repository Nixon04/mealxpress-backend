<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($username, $token)
    {
        //
        $this->username =  $username;
        $this->token = $token;
    }

    public function build(){
       return  $this->subject('Verification Mail')->markdown('emails.verificationMail');
    }

        public function attachments(): array
    {
        return [];
    }
}
