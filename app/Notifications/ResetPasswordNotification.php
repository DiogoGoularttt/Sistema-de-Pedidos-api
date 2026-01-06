<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = config('app.frontend_url')
            . '/reset-password?token='
            . $this->token
            . '&email='
            . urlencode($notifiable->email);

        $name = $notifiable->name ?? 'tudo bem';

        return (new MailMessage)
            ->subject('Redefinição de senha')
            ->greeting('Olá, ' . $name . '!')
            ->line('Recebemos uma solicitação para redefinir a senha da sua conta.')
            ->line('Para continuar, clique no botão abaixo e crie uma nova senha.')
            ->action('Redefinir senha', $url)
            ->line('Este link é válido por 60 minutos.')
            ->line('Se você não solicitou a redefinição, pode ignorar este e-mail com segurança.')
            ->salutation('Equipe Fluxon Digital');
    }
}
