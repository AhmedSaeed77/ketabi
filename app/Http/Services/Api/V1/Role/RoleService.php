<?php

namespace App\Http\Services\Api\V1\Role;

use App\Http\Resources\V1\Role\RoleResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\RoleRepositoryInterface;

abstract class RoleService
{
    private GetService $get;
    private RoleRepositoryInterface $roleRepository;

    public function __construct(
        GetService $getService,
        RoleRepositoryInterface $roleRepository,
    )
    {
        $this->get = $getService;
        $this->roleRepository = $roleRepository;
    }

    public function getInfo() {
        return $this->get->handle(RoleResource::class, $this->roleRepository, 'getInfo');
    }

}
