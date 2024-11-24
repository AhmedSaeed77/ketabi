<?php

namespace App\Http\Services\Api\V1\Learnable\Teacher\Helpers;

use App\Http\Requests\Api\V1\Learnable\LearnableStepOneRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepThreeRequest;
use App\Http\Requests\Api\V1\Learnable\LearnableStepTwoRequest;
use App\Http\Resources\V1\Learnable\LearnableResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\LearnableRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class LearnableTeacherInitiationHelperService
{
    use Responser;

    public function __construct(
        private readonly LearnableRepositoryInterface $learnableRepository,
        private readonly FileManagerService           $fileManager,
        private readonly GetService                   $get,
    )
    {
    }

    public function stepOne(LearnableStepOneRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            if ($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'learnables');
            }

            $learnable = $this->learnableRepository->create([
                'user_id' => auth('api')->id(),
                ...$data
            ]);

            DB::commit();
            return $this->responseSuccess(data: [
                'package_id' => $learnable->id,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function stepTwo(LearnableStepTwoRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $this->learnableRepository->update($data['parent_id'], [
                'price' => $data['price'],
                'subscription_days' => $data['subscription_days'],
                'duration_in_days' => $data['duration_in_days'],
                'duration_in_hours' => $data['duration_in_hours'],
            ]);

            if (isset($data['categories'])) {
                foreach ($data['categories'] as $category) {
                    $this->learnableRepository->create([
                        'user_id' => auth('api')->id(),
                        'parent_id' => $data['parent_id'],
                        'type' => 'category',
                        'name_ar' => $category['name_ar'],
                        'name_en' => $category['name_en'],
                    ]);
                }
            }

            if ($request->package_type == 'repeat') {
                $startDate = Carbon::parse($data['start_date']);
                $endDate = Carbon::parse($data['start_date'])->addDays($data['duration_in_days']);
                $builtSchedules = $this->buildSchedules($startDate, $endDate, $data['schedules'], $data['parent_id']);
                $this->learnableRepository->insert($builtSchedules);
            } elseif ($request->package_type == 'individual') {
                $this->learnableRepository->insert($this->buildIndividual($request->from, $request->to, $data['parent_id']));
            }

            DB::commit();

            return $this->get->handle(LearnableResource::class, $this->learnableRepository, 'getById', [$data['parent_id']], true);
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function stepThree(LearnableStepThreeRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['parent_id', 'type', 'sort', 'name_ar', 'name_en', 'duration_in_hours', 'from', 'to', 'source_platform', 'source_url', 'is_active']);
            $data['parent_id'] = $data['parent_id'] ?? $request->package_id;

            $this->learnableRepository->update($request->lecture_id, $data);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    private function buildSchedules($startDate, $endDate, $schedules, $parent_id)
    {
        $builtSchedules = collect();

        $originalStartDate = $startDate->copy();

        foreach ($schedules as $schedule) {
            $scheduleDate = Carbon::parse($originalStartDate);

            while ($scheduleDate->lte($endDate)) {
                if ($scheduleDate->dayOfWeek == $schedule['day']) {
                    $builtSchedules->push([
                        'user_id' => auth('api')->id(),
                        'parent_id' => $parent_id,
                        'type' => 'live_lecture',
                        'sort' => 1,
                        'from' => $scheduleDate->setTimeFromTimeString($schedule['from'])->format('Y-m-d H:i:s'),
                        'to' => $scheduleDate->setTimeFromTimeString($schedule['to'])->format('Y-m-d H:i:s'),
                        'is_active' => true
                    ]);
                }
                $scheduleDate->addDay();
            }
        }

        $builtSchedules = $builtSchedules->sortBy('from')->values();

        return $builtSchedules->all();
    }

    private function buildIndividual($from, $to, $parent_id)
    {
        return [
            'user_id' => auth('api')->id(),
            'parent_id' => $parent_id,
            'type' => 'live_lecture',
            'sort' => 1,
            'from' => $from,
            'to' => $to,
            'is_active' => true
        ];
    }

}
