<?php

namespace App\Http\Services\Api\V1\Cart;

use App\Http\Requests\Api\V1\Cart\AddCartItemRequest;
use App\Http\Requests\Api\V1\Cart\RemoveCartItemRequest;
use App\Http\Resources\V1\Cart\CartResource;
use App\Http\Services\Api\V1\Cart\Helpers\CartDeciderService;
use App\Http\Services\Mutual\GetService;
use App\Repository\CartRepositoryInterface;

abstract class CartService
{
    public function __construct(
        private readonly CartRepositoryInterface $cartRepository,
        private readonly CartDeciderService $decide,
        private readonly GetService $get,
    )
    {
    }

    public function show() {
        return $this->get->handle(CartResource::class, $this->cartRepository, 'provide', is_instance: true);
    }

    public function add(AddCartItemRequest $request) {
        return $this->decide->add($request->learnable_id);
    }

    public function remove(RemoveCartItemRequest $request) {
        return $this->decide->remove($request->cart_item_id);
    }

}
