<?php

namespace App\Http\Resources\V1\Favourite;

use App\Http\Services\Api\V1\Favourite\Favouritable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    use Favouritable;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'packages' => $this->favouritables['package']['resource']::collection($this->where('favouritable_type', $this->favouritables['package']['type'])->pluck('favouritable')),
            'managers' => $this->favouritables['manager']['resource']::collection($this->where('favouritable_type', $this->favouritables['manager']['type'])->pluck('favouritable')),
        ];
    }
}
