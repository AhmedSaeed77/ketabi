<?php

namespace App\Http\Services\Api\V1\EducationalStage;

use App\Http\Resources\V1\EducationalStage\EducationalStageResource;
use App\Http\Resources\V1\Subject\SubjectResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;

abstract class EducationalStageService
{
    private GetService $get;
    protected EducationalStageRepositoryInterface $educationalStageRepository;
    protected SubjectRepositoryInterface $subjectRepository;
    protected ManagerRepositoryInterface $managerRepository;

    public function __construct(
        GetService                          $getService,
        EducationalStageRepositoryInterface $educationalStageRepository,
        SubjectRepositoryInterface $subjectRepository,
        ManagerRepositoryInterface $managerRepository,
    )
    {
        $this->get = $getService;
        $this->educationalStageRepository = $educationalStageRepository;
        $this->subjectRepository = $subjectRepository;
        $this->managerRepository = $managerRepository;
    }

    public function getInfo()
    {
        return $this->get->handle(EducationalStageResource::class, $this->educationalStageRepository, 'getActive');
    }

    public function show($id) {
        return $this->get->handle(EducationalStageResource::class, $this->educationalStageRepository, 'getById', [$id], true);
    }

    public function getSubjects($id) {
        return $this->get->handle(SubjectResource::class, $this->subjectRepository, 'getByEducationalStage', [$id]);
    }

}
