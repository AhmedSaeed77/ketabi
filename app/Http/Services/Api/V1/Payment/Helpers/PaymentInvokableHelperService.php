<?php

namespace App\Http\Services\Api\V1\Payment\Helpers;

use App\Http\Traits\Responser;
use App\Repository\CartItemRepositoryInterface;
use App\Repository\CartRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class PaymentInvokableHelperService
{
    use Responser;

    public function __construct(
        private readonly CartRepositoryInterface         $cartRepository,
        private readonly CartItemRepositoryInterface     $cartItemRepository,
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly PaymentRepositoryInterface      $paymentRepository,
    )
    {
    }

    public function card($payment, $cart, $metadata)
    {
        $curl = curl_init();

        $data = [
            "profile_id" => env('CLICKPAY_PROFILE_ID'),
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_description" => (string) $payment->id,
            "cart_id" => (string) $cart->id,
            "cart_currency" => "SAR",
            "cart_amount" => $cart->total_amount,
            "callback" => route('payment.callback'),
            "return" => "https://ktibe.com/cart/pay-done/?id=".$payment->id, // todo : check with walid what is the problem here
            "payment_token" => $metadata,
            "customer_details" => [
                "name" => auth('api')->user()->name,
                "email" => auth('api')->user()->email,
                "street1" => "N/A",
                "city" => "Riyadh",
                "state" => "Riyadh",
                "country" => "SA",
                "ip" => request()->ip()
            ]
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://secure.clickpay.com.sa/payment/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . env('CLICKPAY_AUTHORIZATION_KEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $jsonResponse = json_decode($response, true);

        if (isset($jsonResponse['payment_result'])) {
            if ($jsonResponse['payment_result']['response_message'] == 'Authorised') {
                $this->authorizePayment($payment, $cart);
                DB::commit();

                return $this->responseSuccess(message: __('messages.Payment succeeded'));
            } else {
                $this->paymentRepository->update($payment->id, ['status' => 'failed']);
                DB::commit();

                return $this->responseFail(422, __('messages.Payment failed because', ['because' => $jsonResponse['payment_result']['response_message']]));
            }
        } elseif (isset($jsonResponse['redirect_url'])) {
            DB::commit();

            return $this->responseSuccess(data: ['redirect_url' => $jsonResponse['redirect_url']]);
        } else {
            return $this->responseFail(422, __('messages.Something went wrong'));
        }
    }

    public function callback(Request $request)
    {
        $curl = curl_init();

        $data = [
            "profile_id" => env('CLICKPAY_PROFILE_ID'),
            "tran_ref" => $request->tran_ref,
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://secure.clickpay.com.sa/payment/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . env('CLICKPAY_AUTHORIZATION_KEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $jsonResponse = json_decode($response, true);

        $cart = $this->cartRepository->getById($jsonResponse['cart_id']);
        $payment = $this->paymentRepository->getById($jsonResponse['cart_description']);

        if (isset($jsonResponse['payment_result']) && $jsonResponse['payment_result']['response_message'] == 'Authorised') {
            $this->authorizePayment($payment, $cart);

            return $this->responseSuccess();
        } else {
            $this->paymentRepository->update($payment->id, ['status' => 'failed']);

            return $this->responseFail();
        }

    }

    private function authorizePayment($payment, $cart)
    {
        $this->paymentRepository->update($payment->id, ['status' => 'confirmed']);

        $this->subscribe($payment, $cart);

        $this->emptyCart($cart, true);
    }

    public function bankTransfer($payment, $cart, $metadata = null)
    {
        DB::beginTransaction();
        try {
            $this->paymentRepository->update($payment->id, ['status' => 'being_reviewed']);

            $this->emptyCart($cart, false);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    private function subscribe($payment, $cart)
    {
        foreach ($cart?->items as $item) {
            $this->subscriptionRepository->create([
                'user_id' => $payment->user_id,
                'learnable_id' => $item->learnable_id,
                'payment_id' => $payment->id,
                'paid_amount' => $item->learnable?->price ?? 0,
                'ends_at' => $item->learnable?->subscription_days !== null ? Carbon::now()->addDays($item->learnable->subscription_days) : null,
                'is_active' => true,
            ]);
        }
    }

    private function emptyCart($cart, bool $force)
    {
        $empty = $force ? 'forceDelete' : 'delete';

        foreach ($cart->items as $item) {
            $this->cartItemRepository->{$empty}($item->id);
        }

        $this->cartRepository->{$empty}($cart->id);
    }

}
