<?php

namespace App\Repository;

interface CartRepositoryInterface extends RepositoryInterface
{

    public function provide();

    public function isExistedBefore($id, $learnable_id);

    public function isLearnableBeingReviewed($learnable_id);

    public function isPayable($id);

}
