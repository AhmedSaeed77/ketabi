<?php

namespace App\Http\Resources\V1\Chat;

use App\Http\Resources\V1\User\SimpleUserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomResource extends JsonResource
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
            'other_party' => new SimpleUserResource($this->otherParty?->user),
            'content' => $this->latest_message_content,
            'sent_at' => Carbon::parse($this->latestMessage?->created_at)->format('d M Y h:ia'),
            'unread_count' => $this->unread_count,
        ];
    }
}
