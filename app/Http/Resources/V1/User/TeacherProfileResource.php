<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\Learnable\SimpleLearnableResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProfileResource extends JsonResource
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
            'phone' => $this->phone,
            'show_phone' => $this->show_phone,
            'educational_stages' => $this->educational_stages?->implode('name_'.app()->getLocale(), ', '),
            'subjects' => $this->subjects?->implode('name_'.app()->getLocale(), ', '),
            'bio' => $this->bio,
            'last_seen'=>Carbon::parse($this->last_seen)->format('d M Y h:ia'),
            'packages' => SimpleLearnableResource::collection($this->activatedPackages),
            'attachments' => SimpleLearnableResource::collection($this->activatedIndividuallySellableAttachments)
        ];
    }
}
