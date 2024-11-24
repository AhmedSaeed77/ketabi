<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Bank\UserBankRequest;
use App\Http\Requests\Api\V1\Search\SearchRequest;
use App\Http\Requests\Api\V1\User\UserPasswordRequest;
use App\Http\Requests\Api\V1\User\UserProfileRequest;
use App\Http\Services\Api\V1\User\UserService;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $user,
    )
    {
        $this->middleware('auth:api')->except(['searchStudents', 'searchTeachers', 'showTeacher']);
        $this->middleware('only:teacher')->only(['updateBank']);
    }

    public function searchStudents(SearchRequest $request) {
        return $this->user->searchStudents($request);
    }

    public function searchTeachers(SearchRequest $request) {
        return $this->user->searchTeachers($request);
    }

    public function showTeacher($id) {
        return $this->user->showTeacher($id);
    }

    public function updateProfile(UserProfileRequest $request) {
        return $this->user->updateProfile($request);
    }

    public function updatePassword(UserPasswordRequest $request) {
        return $this->user->updatePassword($request);
    }

    public function updateBank(UserBankRequest $request) {
        return $this->user->updateBank($request);
    }

}
