<?php

namespace App\Repository\Eloquent;

use App\Models\Cart;
use App\Repository\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartRepository extends Repository implements CartRepositoryInterface
{
    protected Model $model;

    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function provide() {
        return $this->model::query()->firstOrCreate(['user_id' => auth('api')->id()]);
    }

    public function isExistedBefore($id, $learnable_id) {
        return $this->model::query()
            ->where('carts.id', $id)
            ->whereHas('items', function ($query) use ($learnable_id) {
                $query->where('learnable_id', $learnable_id);
            })
            ->exists();
    }

    public function isLearnableBeingReviewed($learnable_id) {
        return $this->model::query()
            ->where('user_id', auth('api')->id())
            ->whereHas('items', function ($query) use ($learnable_id) {
                    $query->onlyTrashed();
                    $query->where('learnable_id', $learnable_id);
            })
            ->onlyTrashed()
            ->exists();
    }

    public function isPayable($id) {
        return $this->model::query()->where('carts.id', $id)->whereHas('items')->exists();
    }

}
