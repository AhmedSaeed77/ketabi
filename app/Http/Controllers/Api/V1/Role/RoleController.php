<?php

namespace App\Http\Controllers\Api\V1\Role;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleService $role;

    public function __construct(
        RoleService $roleService,
    )
    {
        $this->role = $roleService;
    }

    public function info() {
        return $this->role->getInfo();
    }
}
