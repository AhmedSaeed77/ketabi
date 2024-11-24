<?php

namespace App\Http\Services\Api\V1\Infos;

use App\Http\Resources\V1\Infos\InfosResource;
use App\Repository\InfoRepositoryInterface;
use function App\responseSuccess;

class InfosService
{
    public function __construct(private InfoRepositoryInterface $repository)
    {

    }

    public function __invoke()
    {
        $data['logo'] = url($this->repository->getValue(['logo']));
        $data['fav_icon'] = url($this->repository->getValue(['fav_icon']));
        return responseSuccess(data: $data);
    }
}
