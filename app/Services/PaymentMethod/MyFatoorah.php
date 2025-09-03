<?php

namespace App\Services\PaymentMethod;

use App\Http\Resources\OrderPaymentResource;
use App\Models\Address;
use App\Models\OrderLog;
use App\Models\OrderPayment;
use App\Models\Setting;
use App\Models\UserBalance;
use App\Notifications\CreateAppointmentScheduleNotification;
use App\Traits\GeneralTrait;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyFatoorah implements PaymentInterface
{


    public $mfObj;
    public function __construct()
    {
//        dd($data);

        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));



    }

    public function get_pay_page_data($data)
    {

        $callbackURL = route('callback',['appointmentId'=>$data->id]);
//$returnURL=env('APP_URL').'/success';
        return [
            'CustomerName'       => $data->user?$data->user->name:'',
            'InvoiceValue'       => $data->doctor?$data->doctor->price:0,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => 'test@test.com',
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => $data->user->mobile,
            'Language'           => 'en',
            'CustomerReference'  => $data->id,
            'SourceInfo'         => 'Laravel ',
        ];

    }


    public function add_Payment($data)
    {
        try {
            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode

            $curlData = $this->get_pay_page_data($data);
            $paymentUrl = $this->mfObj->getInvoiceURL($curlData, $paymentMethodId);


            $response=array();
            $response['data']['invoiceURL']=$paymentUrl['invoiceURL'];
            $response['data']['invoiceId']=$paymentUrl['invoiceId'];

            return  $response;
//            return response_api(true, __('message.success'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('message.errorServer'), $response, 500);

        }
    }


    public function add_charagePayment($data)
    {
        // TODO: Implement add_charagePayment() method.
    }


    public function get_pay_page_data_order($data)
    {

        $user=$data[0]->users;

        $price=0.0;
        foreach ($data as $value){
            $price+=$value->price;
        }
        $callbackURL = route('callbackOrder',['orderNumber'=>$data[0]->orderNumber]);
//$returnURL=env('APP_URL').'/success';
        return [
            'CustomerName'       => $user?$user->name:'',
            'InvoiceValue'       => $price??0,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => 'test@test.com',
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => $user->mobile,
            'Language'           => 'en',
            'CustomerReference'  => $user->id,
            'SourceInfo'         => 'Laravel ',
        ];

    }



    public function add_Payment_orders($data)
    {
        try {
            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode

            $curlData = $this->get_pay_page_data_order($data);
            $paymentUrl = $this->mfObj->getInvoiceURL($curlData, $paymentMethodId);


            $response=array();
            $response['data']['invoiceURL']=$paymentUrl['invoiceURL'];
            $response['data']['invoiceId']=$paymentUrl['invoiceId'];


            return response_api(true, __('message.success'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('message.errorServer'), $response, 500);

        }
    }
}
