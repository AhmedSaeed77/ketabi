<?php

namespace App\Http\Controllers\Dashboard\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EducationalStage\EducationalStageRequest;
use App\Http\Requests\Dashboard\Subject\SubjectRequest;
use App\Http\Services\Dashboard\Education\EducationStagesService;
use App\Http\Services\Dashboard\Education\SubjectsService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(private SubjectsService $service){
        $this->middleware('permission:subjects-read')->only('index');
        $this->middleware('permission:subjects-create')->only('create', 'store');
        $this->middleware('permission:subjects-update')->only('edit', 'update');
        $this->middleware('permission:subjects-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function create(){
        return $this->service->create();

    }
    public function store(SubjectRequest $request){
        return $this->service->store($request);
    }
    public function edit($id){
        return $this->service->edit($id);
    }
    public function toggle(){
        return $this->service->toggle();
    }
    public function update(SubjectRequest $request,$id){
        return $this->service->update($request,$id);

    }
    public function destroy($id){
        return $this->service->destroy($id);

    }
}
