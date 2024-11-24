<?php

namespace App\Repository\Eloquent;

use App\Models\EducationalStage;
use App\Repository\EducationalStageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EducationalStageRepository extends Repository implements EducationalStageRepositoryInterface
{
    protected Model $model;

    public function __construct(EducationalStage $model)
    {
        parent::__construct($model);
    }

}
