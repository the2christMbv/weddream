<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeddingAccessNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Félicitations ! Votre espace WedDream est prêt')
        ->greeting('Bonjour ' . $this->user->name . ' !')
        ->line('Votre interface de gestion de mariage a été créée.')
        ->line('Voici vos identifiants :')
        ->line('Email : ' . $this->user->email)
        ->line('Mot de passe : ' . $this->password)
        ->action('Accéder à mon interface', url('/login'))
        ->line('Merci de nous faire confiance pour votre grand jour !');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
