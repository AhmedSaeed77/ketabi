<?php

namespace App\Http\Services\Dashboard\Wallets;

use App\Repository\WalletTransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\update_model;

class TransactionService
{
    private $repository;

    public function __construct(WalletTransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function edit($id)
    {
        $transaction = $this->repository->getById($id);
        return view('dashboard.site.transactions.edit', compact('transaction'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->repository->getById($id, relations: ['wallet']);
            if ($request->withdrawable == 'on')
                update_model($this->repository, $id, ['type' => 'withdrawal']);
            DB::commit();
            return redirect()->route('wallets.transactions', $transaction->wallet->id)->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
