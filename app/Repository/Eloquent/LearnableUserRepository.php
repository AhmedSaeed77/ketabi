<?php

namespace App\Repository\Eloquent;

use App\Models\LearnableUser;
use App\Repository\LearnableUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LearnableUserRepository extends Repository implements LearnableUserRepositoryInterface
{
    protected Model $model;

    public function __construct(LearnableUser $model)
    {
        parent::__construct($model);
    }

}
