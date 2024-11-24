<?php

namespace App\Http\Services\Api\V1\Wallet;

use App\Http\Requests\Api\V1\Wallet\WalletRequest;
use App\Http\Resources\V1\Wallet\WalletResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\WalletRepositoryInterface;
use App\Repository\WalletTransactionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

abstract class WalletService
{
    use Responser;

    public function __construct(
        private readonly WalletRepositoryInterface $walletRepository,
        private readonly WalletTransactionRepositoryInterface $walletTransactionRepository,
        private readonly GetService $get,
    )
    {
    }

    public function show() {
        return $this->get->handle(WalletResource::class, $this->walletRepository, 'first', ['user_id', auth('api')->id()], true);
    }

    public function withdraw(WalletRequest $request) {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $wallet = auth('api')->user()?->wallet;
            $this->walletTransactionRepository->create([
                'wallet_id' => $wallet->id,
                'type' => 'pending_withdrawal',
                'amount' => $data['amount'],
                'reason' => $data['reason'],
            ]);
            DB::commit();
            return $this->responseSuccess(message: __('messages.Withdrawal request sent successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messeges.Something went wrong'));
        }
    }

}
