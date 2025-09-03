<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SenddDoctorNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $body;
    public $userId; // لتحديد الشخص


    public function __construct($title, $body, $userId)
    {
        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('doctor.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'new-notification';
    }
    public function broadcastWith()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }


}
