<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $details;

    public function __construct($subject, $content, $details = [])
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.info_simple');
    }
}
