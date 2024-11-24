<?php

namespace App\Http\Services\Api\V1\Auth\Helpers;

use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Str;

class TeacherRegistrationHelperService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly FileManagerService      $fileManager
    )
    {
    }

    public function register(RegisterRequest $request, $user_id)
    {
        $additionalData = [];

        if ($request->cv !== null) {
            $additionalData['cv'] = $this->fileManager->handle('cv', 'users/cvs');
        }

        $additionalData['bio'] = $request->bio;

        $user = $this->userRepository->getById($user_id);
        $additionalData['reference_id'] = random_int(100, 999) . $user->id . random_int(100, 999);
        $user->update($additionalData);
        $user->educationalStages()->sync($request['educational_stage_id']);
        $user->subjects()->sync($request['subject_id']);
    }
}
