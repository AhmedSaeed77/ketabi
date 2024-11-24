<?php

namespace App\Http\Services\Api\V1\Subject;

use App\Http\Requests\Api\V1\Package\PackageFilterRequest;
use App\Http\Resources\V1\Manager\ManagerResource;
use App\Http\Resources\V1\Package\PackageResource;
use App\Http\Resources\V1\PackageCategory\PackageCategoryResource;
use App\Http\Resources\V1\Subject\SubjectResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;

abstract class SubjectService
{
    private GetService $get;
    protected SubjectRepositoryInterface $subjectRepository;
    protected ManagerRepositoryInterface $managerRepository;

    public function __construct(
        GetService                          $getService,
        SubjectRepositoryInterface $subjectRepository,
        ManagerRepositoryInterface $managerRepository,
    )
    {
        $this->get = $getService;
        $this->subjectRepository = $subjectRepository;
        $this->managerRepository = $managerRepository;
    }

    public function getInfo()
    {
        return $this->get->handle(SubjectResource::class, $this->subjectRepository, 'getActive');
    }

    public function show($id) {
        return $this->get->handle(SubjectResource::class, $this->subjectRepository, 'getById', [$id], true);
    }

}
