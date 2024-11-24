<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\LanguageToggle;

class ChatRoomMessage extends Model
{
    protected $table = 'chat_room_messages';
    protected $guarded = [];

    public function typeValue() : Attribute {
        return Attribute::get(function () {
            return __('db.chat_types.'.$this->type);
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room() {
        return $this->belongsTo(ChatRoom::class);
    }

}
