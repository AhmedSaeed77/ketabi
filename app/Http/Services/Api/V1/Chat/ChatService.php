<?php

namespace App\Http\Services\Api\V1\Chat;

use App\Events\ChatRoomEvent;
use App\Events\OnlineStateEvent;
use App\Events\PushChatMessageEvent;
use App\Http\Requests\Api\V1\Chat\ChatMessageRequest;
use App\Http\Requests\Api\V1\Chat\ChatRequest;
use App\Http\Requests\Api\V1\Chat\LoadMessageRequest;
use App\Http\Resources\V1\Chat\ChatMessageResource;
use App\Http\Resources\V1\Chat\ChatProvideResource;
use App\Http\Resources\V1\Chat\ChatRoomResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\ChatRoomMemberRepositoryInterface;
use App\Repository\ChatRoomMessageRepositoryInterface;
use App\Repository\ChatRoomRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

abstract class ChatService
{
    use Responser;

    public function __construct(
        private readonly ChatRoomRepositoryInterface $chatRoomRepository,
        private readonly ChatRoomMemberRepositoryInterface $chatRoomMemberRepository,
        private readonly ChatRoomMessageRepositoryInterface $chatRoomMessageRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly GetService $get,
    )
    {
    }

    public function provide(ChatRequest $request) {
        return $this->get->handle(ChatProvideResource::class, $this->chatRoomRepository, 'provide', [$request->user_id], true);
    }

    public function getRooms() {
        return $this->get->handle(ChatRoomResource::class, $this->chatRoomRepository, 'getRooms');
    }

    public function getMessages($room_id) {
        $room = $this->chatRoomRepository->getById($room_id);
        if (Gate::allows('access-room', $room)) {
            return $this->get->handle(ChatMessageResource::class, $this->chatRoomMessageRepository, 'getRoomMessages', [$room_id]);
        } else {
            return $this->responseCustom(401, __('messages.You are not allowed to access this resource'));
        }
    }

    public function loadMoreMessages(LoadMessageRequest $request, $room_id) {
        $room = $this->chatRoomRepository->getById($room_id);
        if (Gate::allows('access-room', $room)) {
            return $this->get->handle(ChatMessageResource::class, $this->chatRoomMessageRepository, 'getRoomMessages', [$room_id, $request->after_message_id]);
        } else {
            return $this->responseCustom(401, __('messages.You are not allowed to access this resource'));
        }
    }

    public function send(ChatMessageRequest $request, $room_id) {
        $room = $this->chatRoomRepository->getById($room_id);
        if (Gate::allows('access-room', $room)) {
            DB::beginTransaction();
            try {
                $data = $request->validated();

                $message = $this->chatRoomMessageRepository->create([
                    'chat_room_id' => $room_id,
                    'user_id' => auth('api')->id(),
                    'content' => $data['content'],
                    'type' => $data['type']
                ]);

                $this->chatRoomRepository->update($room_id, ['updated_at' => Carbon::now()]);

                $this->chatRoomMemberRepository->incrementUnread($room_id); // for others

                broadcast(new PushChatMessageEvent($message))->toOthers();

                $this->fireRoomEvent($room);

                DB::commit();
                return $this->responseSuccess(data: new ChatMessageResource($message));
            } catch (Exception $e) {
                DB::rollBack();
                Log::warning('send chat error: ' . $e);
                return $this->responseFail(message: __('messages.Something went wrong'));
            }
        } else {
            return $this->responseCustom(401, __('messages.You are not allowed to access this resource'));
        }
    }

    public function read($room_id) {
        $room = $this->chatRoomRepository->getById($room_id);
        if (Gate::allows('access-room', $room)) {
            $this->chatRoomMemberRepository->resetUnread($room_id);
//            $this->fireRoomEvent($room);
            return $this->responseSuccess();
        } else {
            return $this->responseCustom(401, __('messages.You are not allowed to access this resource'));
        }
    }

    private function fireRoomEvent($room) {
        $parties = $this->chatRoomMemberRepository->get('chat_room_id', $room->id);

        foreach ($parties as $party) {
            broadcast(new ChatRoomEvent($room, $party->user?->id));
        }
    }

    public function goOnline() {
        $this->userRepository->update(auth('api')->id(), ['is_online' => true]);

        broadcast(new OnlineStateEvent(auth('api')->user(), auth('api')->id()));

        return $this->responseSuccess();
    }

    public function goOffline() {
        $this->userRepository->update(auth('api')->id(), ['is_online' => false]);

        broadcast(new OnlineStateEvent(auth('api')->user(), auth('api')->id()));

        return $this->responseSuccess();
    }

}
