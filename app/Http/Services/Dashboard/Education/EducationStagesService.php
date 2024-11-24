<?php

namespace App\Http\Services\Dashboard\Education;

use App\Repository\EducationalStageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class EducationStagesService
{
    public function __construct(private EducationalStageRepositoryInterface $repository){

    }
    public function index(){
        $educational_stages=$this->repository->getAll();
        return view('dashboard.site.educational_stages.index',compact('educational_stages'));
    }
    public function create(){
        return view('dashboard.site.educational_stages.create');
    }

    public function store($request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active']=$request->is_active=='on'?1:0;
            store_model($this->repository , $data);
            DB::commit();
            return redirect()->route('educational-stages.index')->with([ 'success' =>__('messages.created_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }
    public function edit($id){
        $educational_stage = $this->repository->getById($id);
        return view('dashboard.site.educational_stages.edit',compact('educational_stage'));
    }
    public function update($request,$id){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active']=$request->is_active=='on'?1:0;
            update_model($this->repository ,$id , $data);
            DB::commit();
            return redirect()->route('educational-stages.index')->with([ 'success' =>__('messages.updated_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id){
        try {
            delete_model( $this->repository , $id );
            return redirect()->route('educational-stages.index')->with([ 'success' =>__('messages.deleted_successfully')]);
        }catch (\Exception $e){
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
