<?php


namespace App\Services\Firebase;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class FirebaseService
{

    public $factory;
    public $database;
    public $messaging;
    public $notification;

    public function __construct()
    {
        $this->factory = (new Factory)
            ->withServiceAccount(public_path().'/firebase/parmesan-beaf3-firebase-adminsdk-fbsvc-06e46ad23f.json')
            ->withDatabaseUri('https://parmesan-beaf3-default-rtdb.firebaseio.com/');
        $this->database = $this->factory->createDatabase();
        $this->messaging  = $this->factory->createMessaging();
    }

        public function sendNotification(string $title, string $body, array $data, $deviceTokens)
    {
        $tokens = is_array($deviceTokens) ? $deviceTokens : [$deviceTokens];

        $notification = Notification::fromArray([
            'title' => $title,
            'body' => $body,
        ]);

        $message = CloudMessage::new()
            ->withNotification($notification)
            ->withData($data);

        $sendReport = $this->messaging->sendMulticast($message, $tokens);

        return $sendReport->successes()->count();
    }


}
