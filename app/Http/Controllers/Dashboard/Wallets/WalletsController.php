<?php

namespace App\Http\Controllers\Dashboard\Wallets;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Wallets\WalletsService;
use Illuminate\Http\Request;

class WalletsController extends Controller
{
    public function __construct(private WalletsService $service)
    {

    }

    public function index()
    {
        return $this->service->index();
    }

    public function transactions($id)
    {
        return $this->service->transactions($id);
    }
}
