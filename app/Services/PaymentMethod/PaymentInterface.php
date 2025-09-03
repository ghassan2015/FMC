<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 10/8/2019
 * Time: 5:39 م
 */

namespace App\Services\PaymentMethod;

interface PaymentInterface
{

    public function add_Payment($order);
    public function add_charagePayment($data);

}
