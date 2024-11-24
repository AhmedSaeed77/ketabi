<?php

namespace App\Http\Services\Dashboard\Banks;

use App\Repository\BankRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class BankService
{
    private $repository;
    public function __construct(BankRepositoryInterface $bankRepository){
        $this->repository=$bankRepository;
    }
    public function index(){
        $banks=$this->repository->paginate(20);
        return view('dashboard.site.banks.index',compact('banks'));
    }
    public function create(){
        return view('dashboard.site.banks.create');
    }

    public function store($request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            store_model($this->repository , $data);
            DB::commit();
            return redirect()->route('banks.index')->with([ 'success' =>__('messages.created_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }
    public function edit($id){
        $bank = $this->repository->getById($id);
        return view('dashboard.site.banks.edit',compact('bank'));
    }
    public function update($request,$id){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            update_model($this->repository ,$id , $data);
            DB::commit();
            return redirect()->route('banks.index')->with([ 'success' =>__('messages.updated_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id){
        try {
            delete_model( $this->repository , $id );
            return redirect()->route('banks.index')->with([ 'success' =>__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }

}
