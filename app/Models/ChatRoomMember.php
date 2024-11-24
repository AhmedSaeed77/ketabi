<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoomMember extends Model
{
    protected $table = 'chat_room_members';
    protected $guarded = [];

    public function room() {
        return $this->belongsTo(ChatRoom::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeOtherParty(Builder $query, $party_id) {
        $query->where('user_id', '!=', $party_id);
    }
}
