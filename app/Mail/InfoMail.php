<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @property string $subject
 * @property string $content
 * @property array<string, mixed> $details // Specify the value type for array
 */
class InfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $content;
    public array $details;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $content
     * @param array<string, mixed> $details // Specify the value type for the parameter
     */
    public function __construct(string $subject, string $content, array $details = [])
    {
        // Call the parent constructor without arguments
        parent::__construct();

        $this->subject($subject); // Set the subject directly
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
