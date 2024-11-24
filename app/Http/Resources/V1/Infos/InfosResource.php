<?php

namespace App\Http\Resources\V1\Infos;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->key =>[ $this->key => $this->value ]
        ];
    }
}
