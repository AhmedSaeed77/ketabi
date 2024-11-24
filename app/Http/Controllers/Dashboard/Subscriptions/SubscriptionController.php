<?php

namespace App\Http\Controllers\Dashboard\Subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Subscription\SubscriptionRequest;
use App\Http\Services\Dashboard\Subscriptions\SubscriptionsService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct(private SubscriptionsService $service)
    {
        $this->middleware('permission:subscriptions-read')->only('index');
        $this->middleware('permission:subscriptions-update')->only('update', 'edit');
        $this->middleware('permission:subscriptions-delete')->only('destroy');
    }

    public function index()
    {
        return $this->service->index();
    }
    public function toggle()
    {
        return $this->service->toggle();
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(SubscriptionRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
