<?php

namespace App\Http\Services\Api\V1\User\Helpers;

use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Search\SearchRequest;
use App\Http\Requests\Api\V1\User\UserProfileRequest;
use App\Http\Resources\V1\User\SimpleUserResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\UserRepositoryInterface;

class StudentHelperService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly GetService $get,
    )
    {
    }

    public function search(SearchRequest $request) {
        return $this->get->handle(SimpleUserResource::class, $this->userRepository, 'searchStudents', [$request->keyword]);
    }

    public function update(UserProfileRequest $request)
    {
        $this->userRepository->update(auth('api')->id(), ['educational_stage_id' => $request->educational_stage_id]);
    }


}
