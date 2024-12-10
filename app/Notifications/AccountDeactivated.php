<?php

// app/Notifications/AccountDeactivated.php

namespace App\Notifications;

use App\Mail\AccountDeactivatedMail;
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
        return (new AccountDeactivatedMail($this->user));
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
