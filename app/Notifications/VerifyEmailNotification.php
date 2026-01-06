<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends VerifyEmail
{
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(
                Config::get('auth.verification.expire', 60)
            ),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirme seu e-mail')
            ->greeting('Olá, ' . $notifiable->name . '!')
            ->line('Obrigado por criar sua conta em nosso sistema')
            ->line('Para concluir seu cadastro, confirme seu endereço de e-mail clicando no botão abaixo.')
            ->action('Confirmar e-mail', $this->verificationUrl($notifiable))
            ->line('Este link é válido por 60 minutos.')
            ->line('Se você não criou uma conta, nenhuma ação é necessária.');
        // 👆 SEM "Regards, Laravel"
    }
}
