<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.room.{room_id}', function ($user, $room_id) {
    return $user->chatRooms?->contains('chat_room_id', $room_id);
});

Broadcast::channel('chat.room.state.{room_id}', function ($user, $room_id) {
    return $user->chatRooms?->contains('chat_room_id', $room_id);
});

Broadcast::channel('chat.rooms.{user_id}', function ($user, $user_id) {
    return $user->chatRooms()?->exists();
});

Broadcast::channel('user.chat.rooms.state.{user_id}', function ($user, $user_id) {
    return $user->chatRooms()?->exists();
});
