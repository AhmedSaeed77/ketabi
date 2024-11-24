<?php

namespace App\Http\Services\Api\V1\Auth;


use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Auth\UserResetRequest;
use App\Http\Requests\Api\V1\Auth\UserConfirmRequest;
use App\Http\Requests\Api\V1\Auth\UserChangePasswordRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Services\Api\V1\Auth\Helpers\StudentRegistrationHelperService;
use App\Http\Services\Api\V1\Auth\Helpers\TeacherRegistrationHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Mail;
use App\Http\Mail\ResetMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class AuthService
{
    use Responser;

    public function __construct(
                                    private readonly FileManagerService $fileManager,
                                    private readonly UserRepositoryInterface $userRepository,
                                    private readonly StudentRegistrationHelperService $student,
                                    private readonly TeacherRegistrationHelperService $teacher,
                                )
    {
        
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $initialData = $request->only(['type', 'name', 'email', 'phone', 'password','show_phone']);
            if ($request->image !== null)
            {
                $initialData['image'] = $this->fileManager->handle('image', 'users/images');
            }

            $user = $this->userRepository->create($initialData);
            $this->{$request->type}->register($request, $user->id);
            DB::commit();
            $credentials = $request->only('email', 'password');
            auth('api')->attempt($credentials);
            $user = auth('api')->user();

            return $this->responseSuccess(message: __('messages.Successful registration'), data: new UserResource($user));
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::error('CATCH: '. $e);
            return $this->responseFail(message: __('messages.Failed registration'));
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        if ($token) {
            $this->userRepository->update(auth('api')->id(), ['last_seen' => Carbon::now()]);
            if (auth('api')->user()->is_active == 0)
                return $this->responseFail(status: 401, message: __('messages.Your account is not activated yet'));
            return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource(auth('api')->user()));
        }

        return $this->responseFail(status: 401, message: __('messages.wrong credentials'));
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->responseSuccess(message: __('messages.Successfully loggedOut'));
    }

    public function refresh()
    {
        auth('api')->refresh();
        return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource(auth('api')->user()));
    }

    public function details()
    {
        $user = auth('api')->user();
        return $this->responseSuccess(data: new UserResource($user));
    }

    public function reset(UserResetRequest $request)
    {
        try
        {
            $user = $this->userRepository->getByEmail($request->email);
            $randomNumber = random_int(10000, 99999);
            $details = [
                            'title' => 'Reset',
                            'body' =>  $randomNumber,
                        ];

            Mail::to($request->email)->send(new ResetMail($details));
            $this->userRepository->update($user->id,['resetcode' => null]);
            $this->userRepository->update($user->id,['resetcode' => $randomNumber]);
            return $this->responseSuccess(message: __('messages.send_code_successfully'));
        }
        catch (\Exception $e)
        {
            return $this->responseFail(422 , __('messages.Something went wrong'));
        }
    }

    public function resetUserconfirm(UserConfirmRequest $request)
    {
        try
        {
            $user = $this->userRepository->getByEmail($request->email);
            $reset = $this->userRepository->getByConfirm($request->confirm,$user->id);
            if($reset)
            {
                return $this->responseSuccess(message: __('messages.code_Is_Confirm'));
            }
            else
            {
                return $this->responseFail(status: 404, message: __('messages.code_Not_Confirm'));
            }
        }
        catch (\Exception  $e)
        {
            return $this->responseFail(422 , __('messages.Something went wrong'));
        }
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        try
        {
            $user = $this->userRepository->getByEmail($request->email);
            $this->userRepository->update($user->id,['password' => $request->newpassword , 'resetcode' => null]);
            return $this->responseSuccess(message: __('messages.password_Is_Changed'));
        }
        catch (\Exception  $e)
        {
            return $this->responseFail(422 , __('messages.Something went wrong'));
        }
    }

}
