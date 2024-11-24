<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChatRoom extends Model
{
    protected $guarded = [];

    public function latestMessageContent() : Attribute {
        return Attribute::get(function () {
            $content = $this->latestMessage?->content;
            $type = $this->latestMessage?->type;
            $latestMessageContent = '';

            if ($type == 'TEXT') {
                $latestMessageContent .= $content;
            } else {
                $latestMessageContent .= $this->latestMessage?->type_value;
            }
            return Str::limit($latestMessageContent, 30);
        });
    }

    public function unreadCount() : Attribute {
        return Attribute::get(function () {
            return $this->currentMember?->unread_count;
        });
    }

    public function members() {
        return $this->hasMany(ChatRoomMember::class);
    }

    public function messages() {
        return $this->hasMany(ChatRoomMessage::class);
    }

    public function latestMessage() {
        return $this->hasOne(ChatRoomMessage::class)->orderByDesc('id')->limit(1);
    }

    public function otherParty() {
        return $this->hasOne(ChatRoomMember::class)->where('user_id', '!=', auth('api')->id())->limit(1);
    }

    public function currentMember() {
        return $this->hasOne(ChatRoomMember::class)->where('user_id', auth('api')->id())->limit(1);
    }
}
