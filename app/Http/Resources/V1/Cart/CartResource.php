<?php

namespace App\Http\Resources\V1\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'items_count' => $this->items_count,
            'total_amount' => $this->total_amount,
            'items' => CartItemResource::collection($this->items)
        ];
    }
}
