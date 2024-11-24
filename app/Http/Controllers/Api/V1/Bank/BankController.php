<?php

namespace App\Http\Controllers\Api\V1\Bank;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Bank\BankService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct(
        private readonly BankService $bank,
    )
    {
    }

    public function getInfo() {
        return $this->bank->getInfo();
    }
}
