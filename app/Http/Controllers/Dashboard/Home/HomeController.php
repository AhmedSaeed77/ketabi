<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Home\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private HomeService $service){

    }
    public function index() {
        return $this->service->index();
    }
}
