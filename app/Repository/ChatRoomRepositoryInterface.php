<?php

namespace App\Repository;

interface ChatRoomRepositoryInterface extends RepositoryInterface
{

    public function provide($user_id);

    public function getRooms();

}
