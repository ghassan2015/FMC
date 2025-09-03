<?php


namespace App\Services\PaymentMethod;

use App\Http\Resources\cashier\OrderResource;
use App\Models\Cashback;
use App\Models\Order;
use App\Models\UserWallet;
use App\Models\WalletTransaction;

class CashBackPayment implements PaymentInterface{



    public function add_Payment($data)
    {

        $total_price=0.0;
        $order_number=$data[0]->number_order;

        $user_cashback = Cashback::where('user_id', auth('api')->id())->first();
        if (!$user_cashback) {
            Order::query()->where('number_order',$order_number)->delete();


            return [
                'status' => false,
                'data'=>[],
                'message' => __('Localization.there_is_no_wallet'),
                'code' => 422
            ];
        }
        foreach ($data as $value) {
            $total_price += $value->total_price;
        }
        if (($user_cashback->available_balance < $total_price)) {
            Order::query()->where('number_order',$order_number)->delete();

//            foreach ($data as $value) {
//
//
//                $value->update([
//                    'is_paid' => 2,
//                    'payment_type'=>3
//
//                ]);
//            }

            return [
                'status' => false,

                'message' => __('Localization.the_balance_is_insufficient'),
                'data'=>[],
                'code' => 422
            ];
        } else {



            $outstanding_balance = $user_cashback->outstanding_balance + $total_price;
            $available_balance = $user_cashback->available_balance - $total_price;

            $user_cashback->update([
                'available_balance' => $available_balance,
                'outstanding_balance' => $outstanding_balance,
            ]);


            foreach ($data as $value) {

                $value->update([
                    'is_paid' => 1,
                    'payment_type'=>3
                ]);
                WalletTransaction::create([
                    'user_id' => auth('api')->id(),
                    'transaction_type_id' => 3,
                    'amount' => $value->total_price,
                    'cashback_id'=>$user_cashback->id,
                    'currency' =>  'USD',
                    'order_id'=>$value->id,
                    'payment_method_id'=>3,
                    'status'=>1,

                ]);

            }

            $vendor_wallet = UserWallet::query()->where('user_id',$value->vendor->user->id)->first();

            $vendor_wallet->update([
                'total_balance' => ($vendor_wallet->total_balance) + ($value->margin_vendor),
                'outstanding_balance' => ($vendor_wallet->outstanding_balance) + ($value->margin_vendor),

            ]);



            if ($value->reseller){

                $reseller_wallet=UserWallet::query()->where('user_id', $value->reseller->user->id)->first();
                $reseller_wallet->update([
                    'total_balance' => ($reseller_wallet->total_balance) + ($value->margin_reseller),
                    'outstanding_balance' => ($reseller_wallet->outstanding_balance) + ($value->margin_reseller),

                ]);


            }


            if ($value->userStory) {

                $user_story_wallet = UserWallet::query()->where('user_id', $value->user_story_id)->first();
                $user_story_wallet->update([
                    'total_balance' => ($user_story_wallet->total_balance) + ($value->margin_user_story),
                    'outstanding_balance' => ($user_story_wallet->outstanding_balance) + ($value->margin_user_story),
//                        'earning_balance'=>($user_story_wallet->earning_balance)-($order->margin_user_story)

                ]);


            }

            return [
                'status' => true,
                'message' => __('Localization.success_process'),
                'data' => OrderResource::collection($data),
                'code' => 200
            ];
        }


    }


    public function add_charagePayment($data)
    {
        // TODO: Implement add_charagePayment() method.
    }
}
