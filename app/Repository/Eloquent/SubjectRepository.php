<?php

namespace App\Repository\Eloquent;

use App\Models\Subject;
use App\Repository\SubjectRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SubjectRepository extends Repository implements SubjectRepositoryInterface
{
    protected Model $model;

    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }

}
