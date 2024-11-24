<?php

namespace App\Http\Controllers\Dashboard\Contact;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Contact\ContactService;
use Illuminate\Http\Request;

class ContactControlller extends Controller
{
    public function __construct(private ContactService $service){
        $this->middleware('permission:contacts-read')->only('index','show');
        $this->middleware('permission:contacts-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function show($id){
        return $this->service->show($id);
    }
    public function destroy($id){
        return $this->service->destroy($id);
    }
}
