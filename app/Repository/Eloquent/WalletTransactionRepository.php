<?php

namespace App\Repository\Eloquent;

use App\Models\WalletTransaction;
use App\Repository\WalletTransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class WalletTransactionRepository extends Repository implements WalletTransactionRepositoryInterface
{
    protected Model $model;

    public function __construct(WalletTransaction $model)
    {
        parent::__construct($model);
    }



}
