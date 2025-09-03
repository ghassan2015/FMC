<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DoctorAlert extends Notification
{
    use Queueable;

    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['broadcast']; // نحفظها ونبثها
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message,
        ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
