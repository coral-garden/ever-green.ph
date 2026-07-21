<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadCaptured extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $lead) {}

    public function envelope(): Envelope
    {
        $name = trim((string) ($this->lead['name'] ?? ''));
        $email = trim((string) ($this->lead['email'] ?? ''));

        return new Envelope(
            replyTo: filter_var($email, FILTER_VALIDATE_EMAIL)
                ? [new Address($email, $name)]
                : [],
            subject: 'New website lead'.($name !== '' ? ": $name" : ''),
        );
    }

    public function content(): Content
    {
        return new Content(text: 'emails.lead-captured');
    }

    public function attachments(): array
    {
        return [];
    }
}
