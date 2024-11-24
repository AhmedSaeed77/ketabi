<?php

namespace App\Http\Services\Dashboard\Info;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\InfoRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class InfosService
{
    use FileManager;
    public function __construct(private InfoRepositoryInterface $repository,private FileManagerService $fileManagerService)
    {

    }

    public function edit()
    {
        $text=$this->repository->getText();
        $images=$this->repository->getImages();
        return view('dashboard.site.infos.edit', compact('text','images'));
    }

    public function update($request )
    {
        DB::beginTransaction();
        try {
            $this->updateText($request->text);
            $this->updateImages($request->images);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function updateText($array){
        foreach ($array as $key => $value){
            $this->repository->updateValues($key,$value);
        }
    }
    public function updateImages($array){
        foreach ($array as $key => $value){
            $value=$this->fileManagerService->handle('images.' . $key , folderName : 'images/info_control');
            $this->repository->updateValues($key,$value);
        }
    }
}
