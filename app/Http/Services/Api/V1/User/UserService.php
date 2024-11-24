<?php

namespace App\Http\Services\Api\V1\User;

use App\Http\Requests\Api\V1\Bank\UserBankRequest;
use App\Http\Requests\Api\V1\Search\SearchRequest;
use App\Http\Requests\Api\V1\User\UserPasswordRequest;
use App\Http\Requests\Api\V1\User\UserProfileRequest;
use App\Http\Resources\V1\User\SimpleUserResource;
use App\Http\Services\Api\V1\User\Helpers\StudentHelperService;
use App\Http\Services\Api\V1\User\Helpers\TeacherHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

abstract class UserService
{
    use Responser;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly StudentHelperService $student,
        private readonly TeacherHelperService $teacher,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function searchStudents(SearchRequest $request) {
        return $this->student->search($request);
    }

    public function searchTeachers(SearchRequest $request) {
        return $this->teacher->search($request);
    }

    public function showTeacher($id) {
        return $this->teacher->showProfile($id);
    }

    public function updateProfile(UserProfileRequest $request) {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->getById(auth('api')->id());
            $initialData = $request->only(['name', 'email', 'phone','show_phone']);
            if ($request->image !== null) {
                $initialData['image'] = $this->fileManager->handle('image', 'users/images', $user->image);
            }

            $this->userRepository->update(auth('api')->id(), $initialData);

            $this->{auth('api')->user()->type}->update($request);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function updatePassword(UserPasswordRequest $request) {
        DB::beginTransaction();
        try {
            $this->userRepository->update(auth('api')->id(), [
                'password' => $request->new_password,
            ]);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function updateBank(UserBankRequest $request) {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $this->userRepository->update(auth('api')->id(), [
                'bank_id' => $data['bank_id'],
                'bank_account_number' => $data['bank_account_number'],
                'bank_account_iban' => $data['bank_account_iban'],
                'bank_account_name' => $data['bank_account_name'],
            ]);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }
}
