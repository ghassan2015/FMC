<?php
/**
 * Created by PhpStorm.
 * User: Al
 * Date: 13/6/2020
 * Time: 05:23 م
 */

namespace App\Services\Firebase;

use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotification extends FirebaseService
{

    public function __construct()
    {
        parent::__construct();
    }


    public function send($title, $sub_title, $data, $fcms)
    {

        $deviceTokens = is_array($fcms) ? $fcms : [$fcms];
        $message = CloudMessage::new();

        $notification = Notification::fromArray([
            'title' => $title,
            'body' => $sub_title,
        ]);
        $message = $message->withNotification($notification);
        $message = $message->withData($data);
        $sendReport = $this->messaging->sendMulticast($message, $deviceTokens);
    }

}
