<?php

namespace App\Http\Resources\V1\ManagerFile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerFileResource extends JsonResource
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
            'name' => $this->t('name'),
            'description' => $this->t('description'),
            'pages_count' => $this->pages_count,
            'purchases_count' => $this->purchases_count,
            'price' => $this->price,
            'is_free' => $this->is_free,
        ];
    }
}
