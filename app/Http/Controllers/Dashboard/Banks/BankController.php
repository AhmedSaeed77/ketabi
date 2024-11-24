<?php

namespace App\Http\Controllers\Dashboard\Banks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Banks\BankRequest;
use App\Http\Services\Dashboard\Banks\BankService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct(private BankService $service){
        $this->middleware('permission:banks-read')->only('index');
        $this->middleware('permission:banks-create')->only('create', 'store');
        $this->middleware('permission:banks-update')->only('edit', 'update');
        $this->middleware('permission:banks-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function create(){
        return $this->service->create();

    }
    public function store(BankRequest $request){
        return $this->service->store($request);
    }
    public function edit($id){
        return $this->service->edit($id);
    }
    public function update(BankRequest $request,$id){
        return $this->service->update($request,$id);

    }
    public function destroy($id){
        return $this->service->destroy($id);

    }
}
