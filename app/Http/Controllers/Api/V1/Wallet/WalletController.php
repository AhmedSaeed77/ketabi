<?php

namespace App\Http\Controllers\Api\V1\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Wallet\WalletRequest;
use App\Http\Services\Api\V1\Wallet\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function __construct(
        private readonly WalletService $wallet,
    )
    {
        $this->middleware('auth:api');
    }

    public function show() {
        return $this->wallet->show();
    }

    public function withdraw(WalletRequest $request) {
        return $this->wallet->withdraw($request);
    }
}
