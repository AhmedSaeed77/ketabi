<?php

namespace App\Http\Resources\V1\Learnable;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LearnableScheduleResource extends JsonResource
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
            'category_id' => $this->parent?->type == 'category' ? $this->parent_id : null,
            'package_id' => $this->parent?->type == 'public_package' || $this->parent?->type == 'private_package' ? $this->parent_id : $this->parent?->parent_id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->t('name'),
            'type' => $this->type,
            'start' => $this->from,
            'end' => $this->to,
            'sort' => $this->sort,
            'duration_in_hours' => $this->duration_in_hours,
            'source_platform' => $this->source_platform,
            'source_url' => $this->source_url,
            'is_active' => $this->is_active,
            'package' => SimpleLearnableResource::make($this->parent),
            'available_categories' => $this->parent?->type == 'public_package' || $this->parent?->type == 'private_package'
                ? SimpleLearnableResource::collection($this->parent?->categories)
                : SimpleLearnableResource::collection($this->parent?->parent?->categories)
        ];
    }
}
