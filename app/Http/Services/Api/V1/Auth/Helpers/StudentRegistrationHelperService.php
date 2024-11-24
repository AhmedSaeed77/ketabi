<?php

namespace App\Http\Services\Api\V1\Auth\Helpers;

use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Repository\UserRepositoryInterface;

class StudentRegistrationHelperService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }

    public function register(RegisterRequest $request, $user_id)
    {
        $this->userRepository->update($user_id, ['educational_stage_id' => $request->educational_stage_id]);
    }

}
