<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class EmailShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $subject_email;
    public $email_text;
    public function __construct(protected Email $email, $subject_email, $email_text)
    {
        $this->subject_email = $subject_email;
        $this->email_text = $email_text;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('saranskweb2023@mail.ru', auth()->user()->name),
            subject: $this->subject_email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.email.template-email',
            with: [
                'email' => $this->email,
                'text' => $this->email_text,
            ]
        );
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
