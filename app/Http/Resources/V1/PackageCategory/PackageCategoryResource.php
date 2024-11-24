<?php

namespace App\Http\Resources\V1\PackageCategory;

use App\Http\Resources\V1\Package\PackageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->t('name'),
            'packages_count' => $this->packages?->count() ?? 0,
            'packages' => PackageResource::collection($this->packages),
        ];
    }
}
