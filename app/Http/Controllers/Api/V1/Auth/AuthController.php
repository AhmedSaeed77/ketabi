<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Auth\UserResetRequest;
use App\Http\Requests\Api\V1\Auth\UserConfirmRequest;
use App\Http\Requests\Api\V1\Auth\UserChangePasswordRequest;
use App\Http\Services\Api\V1\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $auth)
    {
        $this->middleware('auth:api')->only(['logout', 'refresh', 'details']);
    }

    public function login(LoginRequest $request)
    {
        return $this->auth->login($request);
    }

    public function register(RegisterRequest $request)
    {
        return $this->auth->register($request);
    }

    public function logout()
    {
        return $this->auth->logout();
    }

    public function refresh()
    {
        return $this->auth->refresh();
    }

    public function details()
    {
        return $this->auth->details();
    }

    public function reset(UserResetRequest $request)
    {
        return $this->auth->reset($request);
    }

    public function resetUserconfirm(UserConfirmRequest $request)
    {
        return $this->auth->resetUserconfirm($request);
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        return $this->auth->changePassword($request);
    }
}
