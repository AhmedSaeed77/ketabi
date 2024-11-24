<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\UpdatePasswordRequest;
use App\Http\Requests\Dashboard\Mangers\MangerRequest;
use App\Http\Services\Dashboard\Settings\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private SettingService $service)
    {
    }

    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(MangerRequest $request)
    {
        return $this->service->update($request);
    }

    public function updatePassword (UpdatePasswordRequest $request)
    {
        return $this->service->updatePassword($request);
    }

}
