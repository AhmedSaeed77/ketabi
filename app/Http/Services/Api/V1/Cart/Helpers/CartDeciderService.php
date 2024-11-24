<?php

namespace App\Http\Services\Api\V1\Cart\Helpers;

use App\Http\Traits\Responser;
use App\Repository\CartItemRepositoryInterface;
use App\Repository\CartRepositoryInterface;
use App\Repository\LearnableRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CartDeciderService
{
    use Responser;

    public function __construct(
        private readonly CartRepositoryInterface $cartRepository,
        private readonly CartItemRepositoryInterface $cartItemRepository,
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly LearnableRepositoryInterface $learnableRepository,
        private readonly PaymentRepositoryInterface $paymentRepository,
    )
    {
    }

    private function provide() {
        return $this->cartRepository->provide();
    }

    private function isExistedInCart($cart_id, $learnable_id) {
        return $this->cartRepository->isExistedBefore($cart_id, $learnable_id);
    }

    private function isAlreadySubscribed($learnable_id) {
        return $this->subscriptionRepository->isAlreadySubscribed($learnable_id);
    }

    private function isBeingReviewed($learnable_id) {
        return $this->cartRepository->isLearnableBeingReviewed($learnable_id);
    }

    private function isAccessible($learnable_id) {
        return $this->learnableRepository->isAccessible($learnable_id);
    }

    private function handleAddition($cart_id, $learnable_id) {
        DB::beginTransaction();
        try {
            $this->cartItemRepository->create([
                'cart_id' => $cart_id,
                'learnable_id' => $learnable_id,
            ]);
            DB::commit();
            return $this->responseSuccess(message: __('messages.The item has been added to the cart'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));
        }
    }

    public function add($learnable_id) {
        $cart = $this->provide();

        if ($this->isExistedInCart($cart->id, $learnable_id))
            return $this->responseFail(status: 403, message: __('messages.This item is already in cart'));

        if ($this->isAlreadySubscribed($learnable_id))
            return $this->responseFail(status: 403, message: __('messages.You already have this item'));

        if ($this->isBeingReviewed($learnable_id))
            return $this->responseFail(status: 403, message: __('messages.This item is being reviewed in past payment'));

        if (!$this->isAccessible($learnable_id))
            return $this->responseFail(status: 403, message: __('messages.This item is not accessible for you right now'));

        return $this->handleAddition($cart->id, $learnable_id);
    }

    private function isRemovableItem($cart_item_id) {
        return $this->cartItemRepository->isRemovable($cart_item_id);
    }

    private function handleRemoval($cart_item_id) {
        DB::beginTransaction();
        try {
            $this->cartItemRepository->forceDelete($cart_item_id);
            DB::commit();
            return $this->responseSuccess(message: __('messages.The item has been removed from the cart'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));
        }
    }

    public function remove($cart_item_id) {
        if (!$this->isRemovableItem($cart_item_id))
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));

        return $this->handleRemoval($cart_item_id);
    }

}
