<?php

namespace App\Http\Controllers\Api\V1\Learnable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Learnable\LearnableRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepOneRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepThreeRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepTwoRequest;
use App\Http\Services\Api\V1\Learnable\Teacher\LearnableTeacherService;

class LearnableTeacherController extends Controller
{
    public function __construct(
        private readonly LearnableTeacherService $learnable,
    )
    {
        $this->middleware('auth:api');
        $this->middleware('only:teacher');
    }

    public function initiateStepOne(LearnableStepOneRequest $request) {
        return $this->learnable->initiateStepOne($request);
    }

    public function initiateStepTwo(LearnableStepTwoRequest $request) {
        return $this->learnable->initiateStepTwo($request);
    }

    public function initiateStepThree(LearnableStepThreeRequest $request) {
        return $this->learnable->initiateStepThree($request);
    }

    public function getPackages() {
        return $this->learnable->getPackages();
    }

    public function show($id) {
        return $this->learnable->show($id);
    }

    public function create(LearnableRequest $request) {
        return $this->learnable->create($request);
    }

    public function update(LearnableRequest $request, $id) {
        return $this->learnable->update($request, $id);
    }

    public function delete($id) {
        return $this->learnable->delete($id);
    }

    public function getLectures($id) {
        return $this->learnable->getLectures($id);
    }

    public function getSchedules($id = null) {
        return $this->learnable->getSchedules($id);
    }

    public function getAttachments() {
        return $this->learnable->getAttachments();
    }
}
