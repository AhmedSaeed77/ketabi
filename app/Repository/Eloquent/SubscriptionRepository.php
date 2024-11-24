<?php

namespace App\Repository\Eloquent;

use App\Models\Subscription;
use App\Repository\SubscriptionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SubscriptionRepository extends Repository implements SubscriptionRepositoryInterface
{
    protected Model $model;

    public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }

    public function isAlreadySubscribed($learnable_id) {
        return $this->model::query()
            ->where('learnable_id', $learnable_id)
            ->where('user_id', auth('api')->id())
            ->where('is_active', true)
            ->exists();
    }

    public function endExpiredSubscriptions() {
        return $this->model::query()
            ->where('is_active', true)
            ->whereNotNull('ends_at')
            ->where('ends_at', '<=', Carbon::now())
            ->update(['is_active' => false]);
    }

}
