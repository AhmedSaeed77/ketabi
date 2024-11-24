<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\RoleRequest;
use App\Http\Services\Dashboard\Roles\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $service)
    {
        $this->middleware('permission:roles-read')->only('index');
        $this->middleware('permission:managers-read')->only('managers');
        $this->middleware('permission:roles-create')->only('create', 'store');
        $this->middleware('permission:roles-update')->only('edit', 'update');
        $this->middleware('permission:roles-delete')->only('destroy');
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
    public function mangers($id)
    {
        return $this->service->mangers($id);
    }

    public function create()
    {
        return $this->service->create();

    }

    public function store(RoleRequest $request)
    {
        return $this->service->store($request);

    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(RoleRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);

    }
}
