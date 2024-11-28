<?php

// app/Notifications/AccountDeactivated.php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AccountDeactivated extends Notification
{
    /**
     * @var string
     */
    protected $user;

    /**
     * Crear una nueva notificación de cuenta desactivada.
     *
     * @param  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Enviar la notificación por correo electrónico.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tu cuenta ha sido desactivada')
            ->line('Hola ' . $this->user->name . ',')
            ->line('Tu cuenta ha sido desactivada exitosamente.')
            ->line('Si tienes alguna pregunta, por favor contacta con el soporte.')
            ->action('Volver a activar tu cuenta', url('/'))
            ->line('Gracias por usar nuestros servicios.');
    }

    /**
     * Otros canales para enviar la notificación (SMS, base de datos, etc.)
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
