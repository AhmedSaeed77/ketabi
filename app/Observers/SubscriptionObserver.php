<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Repository\InfoRepositoryInterface;
use App\Repository\WalletTransactionRepositoryInterface;

class SubscriptionObserver
{
    public $afterCommit = true;

    public function __construct(
        private readonly WalletTransactionRepositoryInterface $walletTransactionRepository,
        private InfoRepositoryInterface $infoRepository,
    )
    {
    }

    /**
     * Handle the Subscription "created" event.
     */
    public function created(Subscription $subscription): void
    {
        $wallet = $subscription->learnable?->teacher?->wallet;

        if ($subscription->is_active) {
            $this->walletTransactionRepository->create([
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'amount' => $subscription->paid_amount * (1 - (float)$this->infoRepository->getValue('commission')),
                'from' => $subscription->user?->name,
                'reason' => $subscription->learnable?->t('name'),
            ]);
        }
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
