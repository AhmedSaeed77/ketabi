<?php

namespace App\Http\Services\Api\V1\Learnable;

use App\Http\Resources\V1\Learnable\Source\Accessible\AccessibleLearnableSourceResource;
use App\Http\Resources\V1\Learnable\Source\Protected\ProtectedLearnableSourceResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\LearnableRepositoryInterface;

abstract class LearnableService
{

    public function __construct(
        private readonly LearnableRepositoryInterface $learnableRepository,
        private readonly GetService $get,
    )
    {
    }

    public function getCourse($id) {
        return $this->get->handle(ProtectedLearnableSourceResource::class, $this->learnableRepository, 'getById', [$id], true);
    }

    public function learnCourse($id) {
        return $this->get->handle(AccessibleLearnableSourceResource::class, $this->learnableRepository, 'getById', [$id], true);
    }

}
