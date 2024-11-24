<?php

namespace App\Http\Resources\V1\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image_url,
            'educational_stages' => $this->educational_stages?->implode('name_'.app()->getLocale(), ', '),
            'subjects' => $this->subjects?->implode('name_'.app()->getLocale(), ', '),
            'bio' => $this->bio,
            'last_seen' => Carbon::parse($this->last_seen)->format('d M Y h:ia'),
        ];
    }
}
