<?php

namespace App\Repository\Eloquent;

use App\Models\CartItem;
use App\Repository\CartItemRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartItemRepository extends Repository implements CartItemRepositoryInterface
{
    protected Model $model;

    public function __construct(CartItem $model)
    {
        parent::__construct($model);
    }

    public function isRemovable($id) {
        return $this->model::query()
            ->where('id', $id)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', auth('api')->id());
            })
            ->exists();
    }

}
