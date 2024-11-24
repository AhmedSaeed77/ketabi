<?php

namespace App\Http\Services\Api\V1\Manager;

use App\Http\Resources\V1\Manager\ManagerDetailsResource;
use App\Http\Resources\V1\Manager\ManagerResource;
use App\Http\Services\Api\V1\Manager\Helpers\ManagerHelperService;
use App\Http\Services\Mutual\GetService;
use App\Repository\ManagerRepositoryInterface;

abstract class ManagerService
{
    private ManagerRepositoryInterface $managerRepository;
    private ManagerHelperService $helper;
    private GetService $get;

    public function __construct(
        ManagerRepositoryInterface $managerRepository,
        ManagerHelperService $managerHelperService,
        GetService $getService,
    )
    {
        $this->managerRepository = $managerRepository;
        $this->helper = $managerHelperService;
        $this->get = $getService;
    }

    public function getBestManagers() {
        return $this->get->handle(ManagerResource::class, $this->managerRepository, 'getBestManagers');
    }

    public function show($id) {
        $this->helper->build($id);
        return $this->get->handle(ManagerDetailsResource::class, $this->managerRepository, 'getProfileById', [$id], true);
    }
}
