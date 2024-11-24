<?php

namespace App\Http\Services\Api\V1\User\Helpers;

use App\Http\Requests\Api\V1\Search\SearchRequest;
use App\Http\Requests\Api\V1\User\UserProfileRequest;
use App\Http\Resources\V1\User\SimpleUserResource;
use App\Http\Resources\V1\User\TeacherProfileResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Repository\UserRepositoryInterface;

class TeacherHelperService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly GetService $get,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function search(SearchRequest $request) {
        return $this->get->handle(SimpleUserResource::class, $this->userRepository, 'searchTeachers', [$request->keyword]);
    }

    public function showProfile($id) {
        return $this->get->handle(TeacherProfileResource::class, $this->userRepository, 'getTeacherById', [$id], true);
    }

    public function update(UserProfileRequest $request)
    {
        $additionalData = [];

        $user = $this->userRepository->getById(auth('api')->id());

        $additionalData['bio'] = $request->bio;

        if ($request->cv !== null) {
            $additionalData['cv'] = $this->fileManager->handle('cv', 'users/cvs', $user->cv);
        }

        $user->update($additionalData);
        $user->educationalStages()->sync($request['educational_stage_id']);
        $user->subjects()->sync($request['subject_id']);
    }
}
