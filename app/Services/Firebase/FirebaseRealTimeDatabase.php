<?php
/**
 * Created by PhpStorm.
 * User: Al
 * Date: 13/6/2020
 * Time: 05:23 م
 */

namespace App\Services\Firebase;


class FirebaseRealTimeDatabase extends FirebaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function test() {
        $this->database->getReference('name')->set([
            'name' => "Mohammed"
        ]);
    }
}