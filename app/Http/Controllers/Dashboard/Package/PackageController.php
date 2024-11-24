<?php

namespace App\Http\Controllers\Dashboard\Package;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Package\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(private PackageService $service){
        $this->middleware('permission:packages-read')->only('index','show');
        $this->middleware('permission:packages-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function toggle(){
        return $this->service->toggle();
    }
    public function show($id){
        return $this->service->show($id);
    }
    public function destroy($id){
        return $this->service->destroy($id);
    }
}
