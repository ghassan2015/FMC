<?php

namespace App\Services\PaymentMethod;

use Illuminate\Support\Facades\Http;
use Exception;

class LahzaPaymentService
{
    protected $apiKey;
    protected $callbackUrl;

    public function __construct()
    {
        // Set the API Key and Callback URL (can be configured in your .env)
        $this->apiKey = 'sk_test_gXWXxYZLwpcnYLovJCXUDA3wPylJa2jF3'; // Add to your .env file
        $this->callbackUrl = route('front.payment.success'); // Add to your .env file
    }

    /**
     * Initialize Payment with Lahza API
     *
     * @param \App\Models\Order $order
     * @return array
     * @throws \Exception
     */
    public function initializePayment($order)
    {
        try {
            // Prepare the data to be sent to Lahza's payment gateway
            $payload = [
                'amount' => $order->total_price, // Total price to be paid
                'currency' => 'ILS',
                'amount' => $order->total_price * 100, // Or use another currency if required
                'order_number' => $order->order_number,
                'callback_url' => $this->callbackUrl, // Your callback URL
            ];

            // Make a POST request to Lahza's initialize payment endpoint with authorization header
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post('https://api.lahza.io/transaction/initialize', $payload);


            // dd($response['data']);
            // Check for a successful response
            if ($response['status']) {

                $order->update([
                    'reference' => $response['data']['reference'],
                ]);
                return [
                    'payment_url' => $response['data']['authorization_url'], // Lahza response might vary, check their documentation
                    'reference' => $response['data']['reference'],
                    'access_code' => $response['data']['access_code'],
                    'api_key'=> $this->apiKey

                ];
            } else {
                throw new Exception('Failed to initialize payment: ' . $response->body());
            }
        } catch (Exception $e) {
            throw new Exception('Payment initialization failed: ' . $e->getMessage());
        }
    }
}
