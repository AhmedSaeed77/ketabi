<?php

namespace App\Http\Controllers\Api\V1\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Cart\AddCartItemRequest;
use App\Http\Requests\Api\V1\Cart\RemoveCartItemRequest;
use App\Http\Services\Api\V1\Cart\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cart,
    )
    {
        $this->middleware('auth:api');
    }

    public function show() {
        return $this->cart->show();
    }

    public function add(AddCartItemRequest $request) {
        return $this->cart->add($request);
    }

    public function remove(RemoveCartItemRequest $request) {
        return $this->cart->remove($request);
    }

}
