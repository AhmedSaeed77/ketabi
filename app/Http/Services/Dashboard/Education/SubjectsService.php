<?php

namespace App\Http\Services\Dashboard\Education;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class SubjectsService
{
    public function __construct(private SubjectRepositoryInterface $repository,private FileManagerService $fileManagerService){

    }
    public function index(){
        $subjects=$this->repository->getAll();
        return view('dashboard.site.subjects.index',compact('subjects'));
    }
    public function create(){
        return view('dashboard.site.subjects.create');
    }

    public function store($request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active']=$request->is_active=='on'?1:0;
            if ($request->image)
                $data['image']=$this->fileManagerService->upload('image','images/subjects');
            store_model($this->repository , $data);
            DB::commit();
            return redirect()->route('subjects.index')->with([ 'success' =>__('messages.created_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }
    public function edit($id){
        $subject = $this->repository->getById($id);
        return view('dashboard.site.subjects.edit',compact('subject'));
    }
    public function update($request,$id){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $subject=$this->repository->getById($id);
            $data['is_active']=$request->is_active=='on'?1:0;
            if ($request->image){
                $data['image']=$this->fileManagerService->upload('image','images/subjects');
                $this->fileManagerService->deleteFile($subject->image);
            }
            update_model($this->repository ,$id , $data);
            DB::commit();
            return redirect()->route('subjects.index')->with([ 'success' =>__('messages.updated_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            $subject=$this->repository->getById($id);
            if ($subject->image)
                $this->fileManagerService->deleteFile($subject->image);
            delete_model( $this->repository , $id );
            DB::commit();
            return redirect()->route('subjects.index')->with([ 'success' =>__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }
    public function toggle(){
        DB::beginTransaction();
        try {
            update_model($this->repository ,request('itemId'), ['is_active'=>request('status')]);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }
}
