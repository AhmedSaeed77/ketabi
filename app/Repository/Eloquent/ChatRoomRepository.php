<?php

namespace App\Repository\Eloquent;

use App\Models\ChatRoom;
use App\Repository\ChatRoomRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ChatRoomRepository extends Repository implements ChatRoomRepositoryInterface
{
    protected Model $model;

    public function __construct(ChatRoom $model)
    {
        parent::__construct($model);
    }

    private function roomProvider($user_id) {
        return $this->model::query()
            ->whereHas('members', function ($query) {
                $query->where('user_id', auth('api')?->id());
            })
            ->whereHas('members', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });
    }

    public function provide($user_id) {
        if ($this->roomProvider($user_id)->exists()) {
            return $this->roomProvider($user_id)->first();
        } else {
            $room = $this->create([]);
            $room->members()->insert([
                [
                    'chat_room_id' => $room->id,
                    'user_id' => $user_id,
                    'unread_count' => 0
                ],
                [
                    'chat_room_id' => $room->id,
                    'user_id' => auth('api')->id(),
                    'unread_count' => 0
                ],
            ]);
            return $room;
        }
    }

    public function getRooms() {
        return $this->model::query()
            ->whereHas('members', function ($query) {
                $query->where('user_id', auth('api')->id());
            })
            ->orderByDesc('updated_at')
            ->get();
    }

}
