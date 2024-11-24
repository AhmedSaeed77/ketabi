<?php

namespace App\Http\Resources\V1\Cart;

use App\Http\Resources\V1\Learnable\ProtectedLearnableResource;
use App\Http\Resources\V1\User\SimpleUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->learnable->t('name'),
            'type' => $this->learnable?->type,
            'type_value' => $this->learnable?->type_value,
            'teacher' => new SimpleUserResource($this->learnable?->teacher),
            'image' => $this->image_url,
            'amount' => $this->amount,
            'parent_package' => $this->when($this->parent !== null, new ProtectedLearnableResource($this->parent)),
            'metadata' => new ProtectedLearnableResource($this->learnable),
        ];
    }
}
