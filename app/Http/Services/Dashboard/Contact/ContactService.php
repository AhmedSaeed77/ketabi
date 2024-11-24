<?php

namespace App\Http\Services\Dashboard\Contact;

use App\Repository\ContactRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;

class ContactService
{
    private $repository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->repository = $contactRepository;
    }

    public function index()
    {
        $contacts=$this->repository->paginate(20,orderBy: 'DESC');
        return view('dashboard.site.contacts.index',compact('contacts'));
    }

    public function show($id)
    {
        $contact=$this->repository->getById($id);
        return view('dashboard.site.contacts.show',compact('contact'));
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            delete_model( $this->repository , $id );
            DB::commit();
            return redirect()->route('contacts.index')->with([ 'success' =>__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with([ 'error'  => __('messages.Something went wrong')]);
        }
    }

}
