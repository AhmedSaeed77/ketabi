<?php

namespace App\Repository;

interface SubscriptionRepositoryInterface extends RepositoryInterface
{

    public function isAlreadySubscribed($learnable_id);

    public function endExpiredSubscriptions();

}
