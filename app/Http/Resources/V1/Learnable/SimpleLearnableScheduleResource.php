<?php

namespace App\Http\Resources\V1\Learnable;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleLearnableScheduleResource extends JsonResource
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
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->t('name'),
            'type' => $this->type,
            'start' => $this->from,
            'end' => $this->to,
            'source_platform' => $this->source_platform,
            'source_url' => $this->source_url,
        ];
    }
}
