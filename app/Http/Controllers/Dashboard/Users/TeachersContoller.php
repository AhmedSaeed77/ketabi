<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserRequest;
use App\Http\Services\Dashboard\User\TeacherService;
use Illuminate\Http\Request;

class TeachersContoller extends Controller
{
    public function __construct(private TeacherService $service){
        $this->middleware('permission:teachers-read')->only('index','show');
        $this->middleware('permission:teachers-create')->only('create', 'store');
        $this->middleware('permission:teachers-update')->only('edit', 'update');
        $this->middleware('permission:teachers-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function show($id){
        return $this->service->show($id);
    }
    public function create(){
        return $this->service->create();

    }
    public function store(UserRequest $request){
        return $this->service->store($request);

    }
    public function edit($id){
        return $this->service->edit($id);
    }
    public function toggle(){
        return $this->service->toggle();
    }
    public function update(UserRequest $request,$id){
        return $this->service->update($request,$id);

    }
    public function destroy($id){
        return $this->service->destroy($id);

    }
}
