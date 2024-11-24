<?php

namespace App\Http\Controllers\Dashboard\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Subscription\SubscriptionRequest;
use App\Http\Services\Api\V1\Payment\PaymentService;
use App\Http\Services\Dashboard\Payments\PaymentsService;
use App\Http\Services\Dashboard\Subscriptions\SubscriptionsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct(private PaymentsService $service)
    {
        $this->middleware('permission:payments-read')->only('index','show');
    }

    public function index()
    {
        return $this->service->index();
    }
    public function show($id)
    {
        return $this->service->show($id);
    }
}
