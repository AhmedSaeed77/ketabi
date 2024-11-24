<?php

namespace App\Http\Controllers\Dashboard\Wallets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Transaction\TransactionRequest;
use App\Http\Services\Dashboard\Wallets\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(private TransactionService $service)
    {

    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(TransactionRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }
}
