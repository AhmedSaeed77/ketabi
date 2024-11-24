<?php

namespace App\Repository\Eloquent;

use App\Models\Bank;
use App\Repository\BankRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BankRepository extends Repository implements BankRepositoryInterface
{
    protected Model $model;

    public function __construct(Bank $model)
    {
        parent::__construct($model);
    }



}
