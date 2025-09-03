<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AdminSpecificNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

   public $title;
    public $message;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['broadcast']; // سنرسل فقط عبر البث
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->title,
            'message' => $this->message,
        ]);
    }

    // القناة الخاصة بالأدمين
    public function broadcastOn()
    {
        return new PrivateChannel('admin.' . $this->notifiable->id);
    }
}
