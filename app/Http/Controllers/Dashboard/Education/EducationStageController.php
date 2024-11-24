<?php

namespace App\Http\Controllers\Dashboard\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EducationalStage\EducationalStageRequest;
use App\Http\Services\Dashboard\Education\EducationStagesService;
use Illuminate\Http\Request;

class EducationStageController extends Controller
{
    public function __construct(private EducationStagesService $service){
        $this->middleware('permission:educational_stages-read')->only('index');
        $this->middleware('permission:educational_stages-create')->only('create', 'store');
        $this->middleware('permission:educational_stages-update')->only('edit', 'update');
        $this->middleware('permission:educational_stages-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function create(){
        return $this->service->create();

    }
    public function store(EducationalStageRequest $request){
        return $this->service->store($request);

    }
    public function edit($id){
        return $this->service->edit($id);
    }
    public function toggle(){
        return $this->service->toggle();
    }
    public function update(EducationalStageRequest $request,$id){
        return $this->service->update($request,$id);

    }
    public function destroy($id){
        return $this->service->destroy($id);

    }

}
