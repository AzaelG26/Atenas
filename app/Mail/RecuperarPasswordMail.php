<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperarPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Restablecimiento de contraseña',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        return $this->from('atenasfoodoficial@gmail.com', 'Atenas Oficial')
            ->subject('Restablecimiento de contraseña')
            ->view('mails.password_change')
            ->with(['resetUrl' => $this->resetUrl]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
