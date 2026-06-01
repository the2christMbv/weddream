<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StaffWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    // Définition des variables publiques pour qu'elles soient accessibles dans la vue
    public $member;
    public $password;
    public $wedding;

    /**
     * On passe l'utilisateur (staff), le mot de passe en clair et l'objet Mariage
     */
    public function __construct($member, $password, $wedding)
    {
        $this->member = $member;
        $this->password = $password;
        $this->wedding = $wedding;
    }

    /**
     * Objet de l'e-mail
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue dans l\'équipe WedDream ✨',
        );
    }

    /**
     * Définition de la vue (crée le fichier dans resources/views/emails/staff_welcome.blade.php)
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.staff_welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}