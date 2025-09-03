<?php

namespace App\Notifications;





use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPasswordCode extends Notification
{
    use Queueable;

    protected $code;

    protected $username;
    public function __construct($code, $username)
    {
        $this->code = $code;
        $this->username = $username;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('استرجاع كلمة المرور')
            ->view('emails.forgot_password', [
                'code' => $this->code,
                'username' => $this->username
            ]);
    }
}
