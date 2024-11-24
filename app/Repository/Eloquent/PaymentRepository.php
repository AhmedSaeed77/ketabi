<?php

namespace App\Repository\Eloquent;

use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    protected Model $model;

    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

}
