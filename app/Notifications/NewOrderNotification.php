<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return [ 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'طلب جديد',
            'message' => 'لديك طلب جديد #' . $this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'طلب جديد',
            'message' => 'لديك طلب جديد #' . $this->order->id,
        ]);
    }
}
