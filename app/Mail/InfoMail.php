<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $content;

    /** @var array<string, mixed> */
    public array $details;

    /**
     * Create a new message instance.
     *
     * @param  array<string, mixed>  $details
     */
    public function __construct(string $subject, string $content, array $details = [])
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->details = $details;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('emails.info_simple')
            ->with('content', $this->content)
            ->with('details', $this->details);
    }
}
