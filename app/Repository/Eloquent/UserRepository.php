<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected Model $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getTeacherById($id) {
        return $this->model::query()->where('id', $id)->isTeacher()->first();
    }

    public function searchStudents($keyword) {
        return $this->model::query()
            ->isStudent()
            ->where('is_active', true)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%'.$keyword.'%');
                $query->orWhere('email', $keyword);
                $query->orWhere('phone', 'like', '%'.$keyword.'%');
                $query->orWhere('reference_id', $keyword);;
            })
            ->get();
    }

    public function searchTeachers($keyword) {
        return $this->model::query()
            ->isTeacher()
            ->where('is_active', true)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%'.$keyword.'%');
                $query->orWhere('email', $keyword);
                $query->orWhere('phone', 'like', '%'.$keyword.'%');
                $query->orWhere('reference_id', $keyword);;
            })
            ->get();
    }
    public function getStudents(){
        return $this->model::query()->where('type','student')->with('studentStage')->paginate(20);
    }
    public function getTeachers(){
        return $this->model::query()->where('type','teacher')->paginate(20);
    }

    public function getByEmail($email)
    {
        return $this->model::query()->where('email', $email)->first();
    }

    public function getByConfirm($confirm,$id)
    {
        return $this->model::query()->where('resetcode',$confirm)->where('id',$id)->first();
    }

}
