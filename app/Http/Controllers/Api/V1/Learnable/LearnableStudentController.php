<?php

namespace App\Http\Controllers\Api\V1\Learnable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Learnable\LearnableFilterRequest;
use App\Http\Services\Api\V1\Learnable\Student\LearnableStudentService;

class LearnableStudentController extends Controller
{
    public function __construct(
        private readonly LearnableStudentService $learnable,
    )
    {
        $this->middleware('auth:api')->except(['filter']);
    }

    public function getPackages() {
        return $this->learnable->getPackages();
    }

    public function getAttachments() {
        return $this->learnable->getAttachments();
    }

    public function getSchedules() {
        return $this->learnable->getSchedules();
    }

    public function filter(LearnableFilterRequest $request) {
        return $this->learnable->filter($request);
    }

}
