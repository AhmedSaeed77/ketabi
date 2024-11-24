<?php

namespace App\Http\Services\Api\V1\Learnable\Student;

use App\Http\Requests\Api\V1\Learnable\LearnableFilterRequest;
use App\Http\Resources\V1\Learnable\LearnableScheduleResource;
use App\Http\Resources\V1\Learnable\SimpleLearnableResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\LearnableRepositoryInterface;

abstract class LearnableStudentService
{
    use Responser;

    public function __construct(
        private readonly LearnableRepositoryInterface            $learnableRepository,
        private readonly GetService                              $get,
    )
    {
    }

    public function getPackages() {
        return $this->get->handle(SimpleLearnableResource::class, $this->learnableRepository, 'getSubscribed', [['public_package', 'private_package']]);
    }

    public function getAttachments() {
        return $this->get->handle(SimpleLearnableResource::class, $this->learnableRepository, 'getSubscribed', [['attachment','attachment_lecture']]);
    }

    public function getSchedules() {
        return $this->get->handle(LearnableScheduleResource::class, $this->learnableRepository, 'getSubscribedSchedules');
    }

    public function filter(LearnableFilterRequest $request) {
        return $this->get->handle(SimpleLearnableResource::class, $this->learnableRepository, 'filter', [$request->educational_stage_id, $request->subject_id]);
    }

}
