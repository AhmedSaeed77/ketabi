<?php

namespace App\Repository;

interface CartItemRepositoryInterface extends RepositoryInterface
{

    public function isRemovable($id);

}
