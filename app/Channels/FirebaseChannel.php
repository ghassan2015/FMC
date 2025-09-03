<?php
namespace App\Channels;

use App\Services\Firebase\FirebaseService;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Log;

class FirebaseChannel
{
public function send($notifiable, Notification $notification)
{
    $message = $notification->toFirebase($notifiable);
    if (!$message) {
        return;
    }

    $title = $message['notification']['title'] ?? 'Notification';
    $body = $message['notification']['body'] ?? '';
    $data = $message['data'] ?? [];
    $token = $message['token'] ?? null;

    if (!$token) {
        return;
    }

    $firebase = app(FirebaseService::class);
$firebase->sendNotification($title, $body, $data, $token);
}


}
