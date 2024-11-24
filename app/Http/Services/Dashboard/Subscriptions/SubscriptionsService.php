<?php

namespace App\Http\Services\Dashboard\Subscriptions;

use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class SubscriptionsService
{
    private $repository;
    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository){
        $this->repository=$subscriptionRepository;
    }
    public function index(){
        $subscriptions=$this->repository->paginate(15,relations: ['user','learnable']);
        return view('dashboard.site.subscriptions.index',compact('subscriptions'));
    }
    public function edit($id){
        $subscription = $this->repository->getById($id,columns: ['id','ends_at']);
        return view('dashboard.site.subscriptions.edit',compact('subscription'));
    }
    public function update($request,$id){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            update_model($this->repository ,$id , ['ends_at' => $request->ends_at]);
            DB::commit();
            return redirect()->route('subscriptions.index')->with([ 'success' =>__('messages.updated_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            delete_model( $this->repository , $id );
            DB::commit();
            return redirect()->back()->with([ 'success' =>__('messages.deleted_successfully')]);
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
