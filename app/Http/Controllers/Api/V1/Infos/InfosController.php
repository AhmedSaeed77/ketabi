<?php

namespace App\Http\Controllers\Api\V1\Infos;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Infos\InfosService;
use Illuminate\Http\Request;

class InfosController extends Controller
{
    public function __construct(private InfosService $service)
    {

    }

    public function __invoke()
    {
        return $this->service->__invoke();
    }
}
