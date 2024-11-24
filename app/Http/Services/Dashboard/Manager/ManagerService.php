<?php

namespace App\Http\Services\Dashboard\Manager;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Repository\BankRepositoryInterface;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class ManagerService
{
    use FileManager;

    public function __construct(private ManagerRepositoryInterface $repository,
                                private RoleRepositoryInterface    $roleRepository,
                                private FileManagerService         $filemanagers,)
    {

    }

    public function index()
    {
        $role = $this->roleRepository->getById(1, relations: ['managers']);
        return view('dashboard.site.managers.index', compact('role'));
    }

    public function create()
    {
        $role = $this->roleRepository->getById(request('id'));
        return view('dashboard.site.managers.create', compact('role'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('id', 'image', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;
            if ($request->image !== null)
                $data['image'] = $this->filemanagers->handle('image', 'managers/images');
            $manger = store_model($this->repository, $data, true);
            $manger->addRole($request->id);
            DB::commit();
            return redirect()->route('roles.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $manager = $this->repository->getById($id);
        $role = $manager->roles->first();
        return view('dashboard.site.managers.edit', compact('role', 'manager'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $manager=$this->repository->getById($id);
            $data = $request->except('id', 'image', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;
            if ($request->image !== null)
                $data['image'] = $this->filemanagers->handle('image', 'managers/images',$manager->image);
            update_model($this->repository, $id, $data);
            DB::commit();
            return redirect()->route('roles.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $manger = $this->repository->getById($id);
            if ($manger->image)
                $this->deleteFile($manger->image);
            delete_model($this->repository, $id);
            DB::commit();
            return redirect()->route('roles.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
