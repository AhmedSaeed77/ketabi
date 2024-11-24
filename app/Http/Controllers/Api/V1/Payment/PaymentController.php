<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Payment\PaymentRequest;
use App\Http\Services\Api\V1\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $payment,
    )
    {
        $this->middleware('auth:api');
    }

    public function initiate(PaymentRequest $request) {
        return $this->payment->initiate($request);
    }

    public function callback(Request $request)
    {
        return $this->payment->callback($request);
    }

    public function query($id)
    {
        return $this->payment->query($id);
    }

}
