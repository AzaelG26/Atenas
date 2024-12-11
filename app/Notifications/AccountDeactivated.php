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
     * 
     *
     * @param  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * 
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new AccountDeactivatedMail($this->user));
    }

    /**
     * 
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
