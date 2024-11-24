<?php

namespace App\Http\Services\Api\V1\Bank;

use App\Http\Resources\V1\Bank\BankResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\BankRepositoryInterface;

class BankService
{

    public function __construct(
        private readonly GetService $get,
        private readonly BankRepositoryInterface $bankRepository,
    )
    {
    }

    public function getInfo() {
        return $this->get->handle(BankResource::class, $this->bankRepository);
    }

}
