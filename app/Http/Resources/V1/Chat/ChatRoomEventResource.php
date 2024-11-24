<?php

namespace App\Http\Resources\V1\Chat;

use App\Http\Resources\V1\User\SimpleUserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ChatRoomEventResource extends JsonResource
{
    private $receiver_id;

    public function __construct($resource, $receiver_id)
    {
        $this->receiver_id = $receiver_id;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'other_party' => new SimpleUserResource($this->members()?->otherParty($this->receiver_id)->first()?->user),
            'content' => $this->latest_message_content,
            'sent_at' => Carbon::parse($this->latestMessage?->created_at)->format('d M Y h:ia'),
            'unread_count' => $this->receiver_id == auth('api')->id() ? $this->unread_count : $this->otherParty?->unread_count,
            'is_online' => $this->is_online,
        ];
    }
}
