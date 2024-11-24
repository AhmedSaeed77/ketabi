<?php

namespace App\Http\Services\Api\V1\Manager\Helpers;

use App\Repository\ManagerRepositoryInterface;

class ManagerHelperService
{
    private ManagerRepositoryInterface $managerRepository;

    public function __construct(
        ManagerRepositoryInterface $managerRepository,
    )
    {
        $this->managerRepository = $managerRepository;
    }

    public function usersCount($manager_id) {
        return $this->userRepository->countByManager($manager_id);
    }

    public function build($manager_id) {
        $usersCount = $this->usersCount($manager_id);
        request()->request->add([
            'extras' => [
                'users_count' => $usersCount,
            ]
        ]);
    }

}
