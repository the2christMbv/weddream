<?php

namespace App\Mail;

use App\Models\Wedding;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeddingMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Wedding $wedding,
        public string $password
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Félicitations ! Vos accès WedDream',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.wedding_welcome', // Tu devras créer cette vue
        );
    }
}