<?php

namespace App\Observers;

use App\Models\User;
use App\Repository\WalletRepositoryInterface;

class UserObserver
{
    public $afterCommit = true;

    public function __construct(
        private readonly WalletRepositoryInterface $walletRepository,
    )
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->walletRepository->create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $wallet = $this->walletRepository->first('user_id', $user->id);
        $payload = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
        ];

        if (!$wallet) {
            $this->walletRepository->create($payload);
        } else {
            $this->walletRepository->update($wallet->id, $payload);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
