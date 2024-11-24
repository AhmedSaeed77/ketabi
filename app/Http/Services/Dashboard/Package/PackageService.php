<?php

namespace App\Http\Services\Dashboard\Package;

use App\Repository\LearnableRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\update_model;

class PackageService
{
    public function __construct(private LearnableRepositoryInterface $repository)
    {
    }

    public function index()
    {
        $packages = $this->repository->getPaginatedPackages();
        return view('dashboard.site.packages.index', compact('packages'));
    }
    public function show($id)
    {
        $package = $this->repository->getById($id,relations : ['categories','categories.lectures','lectures','attachments']);
        return view('dashboard.site.packages.show', compact('package'));
    }


    public function destroy($id)
    {

        try {
            $this->repository->delete($id, ['image', 'source_url']);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
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
