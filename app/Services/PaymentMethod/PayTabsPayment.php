<?php

namespace App\Services\PaymentMethod;

use App\Http\Resources\cashier\OrderResource;
use App\Http\Resources\OrderPaymentResource;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderPayment;
use App\Models\Setting;
use App\Models\UserBalance;
use App\Traits\GeneralTrait;
use GuzzleHttp\Client;

class PayTabsPayment implements PaymentInterface
{


    private $merchant_id;
    private $merchant_secretKey;

    private $pay_page_url;
    private $verify_payment_url;
    private $headers;
//    use GeneralTrait;

private $order;
    public function __construct()
    {

        $this->merchant_id = "96931";
        $this->merchant_secretKey = "SJJNGBKTDZ-JGWLT6NLNL-MNH26NJGKZ";

        $this->pay_page_url = "https://secure.paytabs.sa/payment";
        $this->verify_payment_url = "https://secure.paytabs.sa/apiv2/verify_payment";



    }

    public function get_pay_page_data($order)
    {

        $total_price =0.0;
        $order_number=$order[0]->number_order;
        foreach ($order as $value) {
            $total_price += $value->total_price;
        }


        $returnUrl = 'https://ybiapi.fresh-app.com/success.php?order_number='.$order_number;
        $callbacknUrl = 'https://ybiapi.fresh-app.com/callback.php?order_number='.$order_number;

        $fields = array(

            "profile_id" => $this->merchant_id,
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => $order_number,
            "cart_currency" => "SAR",
            "cart_amount" => $total_price,
            "cart_description" => "Add Money to Wallet",
            "paypage_lang" => "en",
            "customer_details" => [
                "name" => auth('api')->user()->name,
                "email" => auth('api')->user()->email,
                "phone" =>auth('api')->user()->email ,
                "street1" => auth('api')->user()->address[0]->title,
                "city" => auth('api')->user()->address[0]->city->name_en,
                "state" => auth('api')->user()->address[0]->city->name_en,
                "country" => auth('api')->user()->country->ios2,
                "zip" => auth('api')->user()->country->phone_code,

            ],
            "shipping_details" => [
                "name" => auth('api')->user()->name,
                "email" => auth('api')->user()->email,
                "phone" =>auth('api')->user()->email ,
                "street1" => auth('api')->user()->address[0]->title,
                "city" => auth('api')->user()->address[0]->city->name_en,
                "state" => auth('api')->user()->address[0]->city->name_en,
                "country" => auth('api')->user()->country->ios2,
                "zip" => auth('api')->user()->country->phone_code,


            ],
            "site_url" => env('APP_URL'),
            'return_url' => $returnUrl,
            "framed" => true,
            'ip_customer' => $_SERVER['REMOTE_ADDR'],
             'ip_merchant' =>isset($_SERVER['SERVER_ADDR'])? $_SERVER['SERVER_ADDR'] : '::1',
            "framed_return_top" => true,
            "framed_return_parent" => true,
            "hide_shipping" => true,
            "callback"=>$callbacknUrl,
            "return"=>$returnUrl,
            "config_id" => 2654,


        );

        return $fields;
    }


    public function add_Payment($data)
    {
        $client = new Client();
        $headers = array(
            "authorization" => "SJJNGBKTDZ-JGWLT6NLNL-MNH26NJGKZ",
            "Content-Type" => "application/json"
        );
        $data = [
            'headers' => $headers,
            'body' => json_encode($this->get_pay_page_data($data)),
        ];
        $response = $client->request('POST', $this->pay_page_url.'/request', $data);

        $body = $response->getBody();


        return $this->handle_pay_page_response(json_decode($body, true));


    }


    public function handle_pay_page_response($data)
    {



        if ($data["tran_ref"]) {
            $response = [
                'status' => true,
                'message' => __('Localization.success_process'),
                'code' => 200,
                'data' =>[
                    'redirect_url'=>$data['redirect_url'],

                'payment_reference' => $data['tran_ref']
                ]
            ];


        } else {
            $response = [
                'status' => false,
                'result' => "Error",
                'response_code' => $data['code'],
                'payment_url' => "",
                'payment_reference' => -1,
            ];
        }
        return $response;
    }


    public function verify_payment($payment_reference)
    {


        $fields = array(

            "profile_id" => $this->merchant_id,
            "tran_ref" => $payment_reference,


        );
        $headers = array(
            "authorization" => "SJJNGBKTDZ-JGWLT6NLNL-MNH26NJGKZ",
            "Content-Type" => "application/json"
        );

        $data = [
            'headers' => $headers,
            'body' => json_encode($fields),
        ];
        $client=new Client();
        $response = $client->request('POST', $this->pay_page_url.'/query', $data);
        $body = $response->getBody();


        return $this->handle_pay_complete_payment_response(json_decode($body, true));

    }

    public function handle_pay_complete_payment_response($data)
    {


        $order = Order::where('order_number', $data["cart_id"])->get();

        if (isset($order) && $order->count() > 0) {
            if ($data["payment_result"]) {

                foreach ($order as $value){
                    $value->update([
                        'is_paid'=>1
                    ]);
                }

                $response['data']=OrderResource::collection($order);
                return response_api(true, __('Localization.success_process'),$response, 200);

            } else {


                $response['data'] = null;
                return response_api(false, __('Localization.payment_fail'),$response, 422);


            }
        } else {
            $response['data'] = null;
            return response_api(false, __('Localization.payment_fail'),$response, 422);

        }


    }



    public function get_charge_page_data($data){
        $callbacknUrl = 'https://ybiapi.fresh-app.com/charage_callback.php?user_name='.auth('api')->id();
//        $returnUrl = ';

        $fields = array(

            "profile_id" => $this->merchant_id,
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => get_order_number(),
            "cart_currency" => "SAR",
            "cart_amount" =>$data,
            "cart_description" => "Add Money to Wallet",
            "paypage_lang" => "en",
            "customer_details" => [
                "name" => auth('api')->user()->name,
                "email" => auth('api')->user()->email,
                "phone" =>auth('api')->user()->email ,
                "street1" => auth('api')->user()->address[0]->title,
                "city" => auth('api')->user()->address[0]->city->name_en,
                "state" => auth('api')->user()->address[0]->city->name_en,
                "country" => auth('api')->user()->country->ios2,
                "zip" => auth('api')->user()->country->phone_code,

            ],
            "shipping_details" => [
                "name" => auth('api')->user()->name,
                "email" => auth('api')->user()->email,
                "phone" =>auth('api')->user()->email ,
                "street1" => auth('api')->user()->address[0]->title,
                "city" => auth('api')->user()->address[0]->city->name_en,
                "state" => auth('api')->user()->address[0]->city->name_en,
                "country" => auth('api')->user()->country->ios2,
                "zip" => auth('api')->user()->country->phone_code,


            ],
            'site_url' => 'https://ybiapi.fresh-app.com/',

//            "site_url" => env('APP_URL'),
//            'return_url' => $returnUrl,
            "framed" => true,
            'ip_customer' => $_SERVER['REMOTE_ADDR'],
            'ip_merchant' =>isset($_SERVER['SERVER_ADDR'])? $_SERVER['SERVER_ADDR'] : '::1',
            "framed_return_top" => true,
            "framed_return_parent" => true,
            "hide_shipping" => true,
            "callback"=>'https://ybiapi.fresh-app.com/charage_callback.php?user_name='.auth('api')->id(),
            "return"=>'https://ybiapi.fresh-app.com/charage_return.php?user_name='.auth('api')->id().'&amount='.$data,
            "config_id" => 2654,


        );

        return $fields;

    }

    public function add_charagePayment($data){
        $client = new Client();
        $headers = array(
            "authorization" => "SJJNGBKTDZ-JGWLT6NLNL-MNH26NJGKZ",
            "Content-Type" => "application/json"
        );
        $data = [
            'headers' => $headers,
            'body' => json_encode($this->get_charge_page_data($data)),
        ];
        $response = $client->request('POST', $this->pay_page_url.'/request', $data);

        $body = $response->getBody();

        return $this->handle_pay_page_response(json_decode($body, true));

    }

}
