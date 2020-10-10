<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Смяна на парола')
            ->line('Изпратена е заявка за смяна на паролата в нашата платформа.')
            ->action('Смени парола', url('password/reset', $this->token))
            ->line('Ако не сте подали заявката вие не се изисква никакво действие.');
    }
}
