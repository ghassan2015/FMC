<?php


namespace App\Services\PaymentMethod;

use App\Http\Resources\cashier\OrderResource;
use App\Models\Order;
use App\Models\UserWallet;
use App\Models\WalletTransaction;

class WalletPayment implements PaymentInterface
{


    public function add_Payment($orders)
    {


        $order_number=$orders[0]->number_order;
//        return $order_number;
        $total_price = 0.0;
        foreach ($orders as $value) {

            $total_price += $value->total_price;
        }
//        dd( $orders);
        $user_wallet = UserWallet::where('user_id', auth('api')->id())->first();
        if (!$user_wallet) {

            Order::query()->where('number_order',$order_number)->delete();

//            foreach ($orders as $value) {
//
////                $value->update([
////                    'is_paid' => 2,
////                    'payment_type' => 2
////
////                ]);
//            }
            return [
                'status' => false,
                'data'=>[],
                'message' => __('Localization.there_is_no_wallet'),
                'code' => 422
            ];
        }
        if (($user_wallet->available_balance < $total_price)) {
//            foreach ($orders as $value) {
//
////                $value->update([
////                    'is_paid' => 2,
////                    'payment_type' => 2
////
////                ]);
//            }

            Order::query()->where('number_order',$order_number)->delete();
            return [
                'status' => false,
                'data'=>[],

                'message' => __('Localization.the_balance_is_insufficient'),
                'code' => 422
            ];
        } else {


            $outstanding_balance = $user_wallet->outstanding_balance + $total_price;
            $available_balance = $user_wallet->available_balance - $total_price;

            $user_wallet->update([
                'available_balance' => $available_balance,
                'outstanding_balance' => $outstanding_balance,
//                'last_transaction' => $walletTransaction->id,
            ]);

            foreach ($orders as $value) {

                $value->update([
                    'is_paid' => 1,
                    'payment_type' => 2
                ]);

                WalletTransaction::create([
                    'user_id' => auth('api')->id(),
                    'transaction_type_id' => 3,
                    'amount' => $value->total_price,
                    'wallet_id' => $user_wallet->id,
                    'currency' => 'USD',
                    'order_id' => $value->id,
                    'payment_method_id'=>2,
                    'status'=>1,

                ]);


                $vendor_wallet = UserWallet::query()->where('user_id', $value->vendor->user->id)->first();

                $vendor_wallet->update([
                    'total_balance' => ($vendor_wallet->total_balance) + ($value->margin_vendor),
                    'outstanding_balance' => ($vendor_wallet->outstanding_balance) + ($value->margin_vendor),

                ]);


                if ($value->reseller) {

                    $reseller_wallet = UserWallet::query()->where('user_id', $value->reseller->user->id)->first();
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



            }


            return [
                'status' => true,
                'message' => __('Localization.success_process'),
                'data' => OrderResource::collection($orders),
                'code' => 200
            ];

        }


    }

    public function add_charagePayment($data)
    {
        // TODO: Implement add_charagePayment() method.
    }
}
