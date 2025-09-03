<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TicketUpdatedNotification extends Notification
{
    use Queueable;

    public $title;
    public $body;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return ['broadcast']; // فقط broadcast
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->title,
            'body' => $this->body,
        ]);
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'doctor.' . $this->id; // القناة الخاصة لكل admin
    }
}
