<?php

namespace App\Http\Services\Api\V1\Learnable\Teacher;

use App\Http\Requests\Api\V1\Learnable\LearnableRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepOneRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepThreeRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepTwoRequest;
use App\Http\Resources\V1\Learnable\LearnableScheduleResource;
use App\Http\Resources\V1\Learnable\SimpleLearnableTeacherResource;
use App\Http\Services\Api\V1\Learnable\Teacher\Helpers\LearnableTeacherInitiationHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\LearnableRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

abstract class LearnableTeacherService
{
    use Responser;

    public function __construct(
        private readonly GetService                              $get,
        private readonly FileManagerService                      $fileManager,
        private readonly LearnableRepositoryInterface            $learnableRepository,
        private readonly UserRepositoryInterface                 $userRepository,
        private readonly LearnableTeacherInitiationHelperService $initiate,
    )
    {
    }

    public function initiateStepOne(LearnableStepOneRequest $request)
    {
        return $this->initiate->stepOne($request);
    }

    public function initiateStepTwo(LearnableStepTwoRequest $request)
    {
        return $this->initiate->stepTwo($request);
    }

    public function initiateStepThree(LearnableStepThreeRequest $request)
    {
        return $this->initiate->stepThree($request);
    }

    public function getPackages()
    {
        return $this->get->handle(SimpleLearnableTeacherResource::class, $this->learnableRepository, 'getPackages');
    }

    public function show($id)
    {
        return $this->get->handle(SimpleLearnableTeacherResource::class, $this->learnableRepository, 'getById', [$id], true);
    }

    public function create(LearnableRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['user_id'] = auth('api')->id();

            if ($request->image !== null)
                $data['image'] = $this->fileManager->handle('image', 'learnables');

            if ($request->source_platform == null && $request->source_url !== null)
                $data['source_url'] = $this->fileManager->handle('source_platform', 'learnables');
            if ($request->is_individually_sellable != null)
                $data['is_individually_sellable'] = $request->is_individually_sellable;
            $learnable = $this->learnableRepository->create($data);

            if ($request->students !== null)
                $learnable->students()->sync($request->students);

            DB::commit();
            return $this->responseSuccess(message: __('messages.created_successfully'), data: new SimpleLearnableTeacherResource($learnable));
        } catch (Exception $e) {
            DB::rollBack();
//            return $e;
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function update(LearnableRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['user_id'] = auth('api')->id();

            $learnable = $this->learnableRepository->getById($id);

            if ($request->image !== null)
                $data['image'] = $this->fileManager->handle('image', 'learnables', $learnable->image);

            if ($request->source_platform == null && $request->source_url !== null)
                $data['source_url'] = $this->fileManager->handle('source_platform', 'learnables', $learnable->source_url);

            if ($request->is_individually_sellable != null)
                $data['is_individually_sellable'] = $request->is_individually_sellable;

            $this->learnableRepository->update($id, $data);

            if ($request->students !== null)
                $learnable->students()->sync($request->students);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function delete($id)
    {
        $learnable = $this->learnableRepository->getById($id);
        if ($this->learnableRepository->isDeletable($id) && $learnable->is_deletable) {
            $this->learnableRepository->delete($id, ['image', 'source_url']);

            return $this->responseSuccess(message: __('messages.deleted_successfully'));
        } else {
            return $this->responseFail(status: 401, message: __('messages.you are not authorized to do this action'));
        }
    }

    public function getLectures($id)
    {
        return $this->get->handle(LearnableScheduleResource::class, $this->learnableRepository, 'getLectures', [$id]);
    }

    public function getSchedules($id = null)
    {
        return $this->get->handle(LearnableScheduleResource::class, $this->learnableRepository, 'getSchedules', [$id]);
    }

    public function getAttachments()
    {
        return $this->get->handle(SimpleLearnableTeacherResource::class, $this->learnableRepository, 'getAttachments');
    }

}
