<?php

namespace App\Http\Controllers\Dashboard\Mangers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Mangers\MangerRequest;
use App\Http\Services\Dashboard\Manager\ManagerService;
use Illuminate\Http\Request;

class MangerController extends Controller
{
    public function __construct(private ManagerService $service)
    {
        $this->middleware('permission:managers-create')->only('create', 'store');
        $this->middleware('permission:managers-update')->only('edit', 'update', 'toggle');
        $this->middleware('permission:managers-delete')->only('destroy');
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(MangerRequest $request)
    {
        return $this->service->store($request);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function toggle()
    {
        return $this->service->toggle();
    }

    public function update(MangerRequest $request, $id)
    {
        return $this->service->update($request, $id);

    }

    public function destroy($id)
    {
        return $this->service->destroy($id);

    }
}
