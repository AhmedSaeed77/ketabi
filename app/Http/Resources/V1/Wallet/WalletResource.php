<?php

namespace App\Http\Resources\V1\Wallet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_amount' => $this->total_amount,
            'withdrawable_amount' => $this->withdrawable_amount,
            'subscriptions' => WalletHistoryResource::collection($this->deposits),
            'withdrawals' => WalletHistoryResource::collection($this->withdrawals),
        ];
    }
}
