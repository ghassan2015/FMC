<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class CustomDbChannel
{

    public function send($notifiable, Notification $notification)
    {
        // Retrieve notification data from the toDatabase method
        $data = $notification->toDatabase($notifiable);

        // Ensure $data is an array to avoid issues with array operations
        $data = is_array($data) ? $data : [];

        // Return the notification entry creation
        return $notifiable->routeNotificationFor('database')->create([
            'type' => get_class($notification),
            'data' => $data,
            'title' => $data['title'] ?? null, // Safely retrieve the 'title' key
            'body' => $data['body'] ?? null,   // Safely retrieve the 'body' key
            'order_id' => $data['order_id'] ?? null, // Default to null if key doesn't exist
            'product_id' => $data['product_id'] ?? null, // Default to null if key doesn't exist

            'read_at' => null,
            'notification_type' => $data['notification_type'] ?? 'general', // Default to 'general'
        ]);
    }

}
