<?php

namespace App\Repository\Eloquent;

use App\Models\Learnable;
use App\Repository\LearnableRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LearnableRepository extends Repository implements LearnableRepositoryInterface
{
    protected Model $model;

    public function __construct(Learnable $model)
    {
        parent::__construct($model);
    }

    public function getCategories($id) {
        return $this->model::query()->where('type', 'category')->where('parent_id', $id)->get();
    }

    public function isDeletable($id) {
        return $this->model::query()->where('user_id', auth('api')->id())->exists();
    }

    public function isAccessible($id) {
        return $this->model::query()
            ->where('id', $id)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('type', 'public_package');
                    $query->orWhere(function ($query) {
                        $query->where('type', 'private_package');
                        $query->whereHas('students', function ($query) {
                            $query->where('users.id', auth('api')->id());
                        });
                    });
                    $query->orWhere('type', 'attachment');
                    $query->orWhere('type', 'attachment_lecture');
                });
                $query->where('is_active', true);
            })
            ->exists();
    }

    public function getSchedules($id) {
        return $this->model::query()
            ->where(function ($query) use ($id) {
                if ($id !== null) {
                    $query->where('parent_id', $id);
                    $query->orWhere(function ($query) use ($id) {
                        $query->whereHas('parent', function ($query) use ($id) {
                            $query->where('type', 'category');
                            $query->where('parent_id', $id);
                        });
                    });
                }
            })
            ->where('user_id', auth('api')->id())
            ->where('to', '>', Carbon::now())
            ->whereIn('type', ['live_lecture', 'recorded_lecture'])
            ->with('parent')
            ->get();
    }

    public function getLectures($id) {
        return $this->model::query()
            ->where(function ($query) use ($id) {
                if ($id !== null) {
                    $query->where('parent_id', $id);
                    $query->orWhere(function ($query) use ($id) {
                        $query->whereHas('parent', function ($query) use ($id) {
                            $query->where('type', 'category');
                            $query->where('parent_id', $id);
                        });
                    });
                }
            })
            ->where('user_id', auth('api')->id())
            ->whereIn('type', ['live_lecture', 'recorded_lecture'])
            ->get();
    }

    public function getPackages() {
        return $this->model::query()->where('user_id', auth('api')->id())->whereIn('type', ['public_package', 'private_package'])->get();
    }
    public function getPaginatedPackages() {
        return $this->model::query()->whereIn('type', ['public_package', 'private_package'])->paginate(20);
    }

    public function getAttachments() {
        return $this->model::query()->where('user_id', auth('api')->id())->whereIn('type',[ 'attachment','attachment_lecture'])->with('parent')->get();
    }

    public function getSubscribed(array $types) {
        return $this->model::query()
            ->whereIn('type', $types)
            ->whereHas('subscriptions', function ($query) {
                $query->where('subscriptions.user_id', auth('api')->id());
                $query->where('subscriptions.is_active', true);
            })
            ->get();
    }

    public function getSubscribedSchedules() {
        return $this->model::query()
            ->where(function ($query) {
                $query->whereHas('parent', function ($query) {
                    $query->whereIn('type', ['private_package', 'public_package']);
                    $query->whereHas('subscriptions', function ($query) {
                        $query->where('subscriptions.user_id', auth('api')->id());
                        $query->where('is_active', true);
                    });
                });
                $query->orWhereHas('parent', function ($query) {
                    $query->where('type', 'category');
                    $query->whereHas('parent', function ($query) {
                        $query->whereIn('type', ['private_package', 'public_package']);
                        $query->whereHas('subscriptions', function ($query) {
                            $query->where('subscriptions.user_id', auth('api')->id());
                            $query->where('is_active', true);
                        });
                    });
                });
            })
            ->with('parent')
            ->where('to', '>', Carbon::now())
            ->whereIn('type', ['live_lecture'])
            ->get();
    }

    public function filter($educational_stage_id = null, $subject_id = null) {
        return $this->model::query()
            ->where(function ($query) use ($educational_stage_id, $subject_id) {
                if ($educational_stage_id !== null)
                    $query->where('educational_stage_id', $educational_stage_id);

                if ($subject_id !== null)
                    $query->where('subject_id', $subject_id);
            })
            ->where('is_active', true)
            ->get();
    }
}
