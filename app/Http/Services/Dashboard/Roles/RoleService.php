<?php

namespace App\Http\Services\Dashboard\Roles;

use App\Repository\ManagerRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class RoleService
{
    public function __construct(private RoleRepositoryInterface $repository,

    private PermissionRepositoryInterface $permissionRepository)
    {

    }

    public function index()
    {
        $roles = $this->repository->paginate(20);
        return view('dashboard.site.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions=$this->permissionRepository->getAll();
        return view('dashboard.site.roles.create', compact('permissions'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data=$request->except('permissions');
            $data['name']=str_replace(' ','-',strtolower($data['display_name_en']));
            $role = store_model($this->repository, $data, true);
            $role->permissions()->attach($request->permissions);
            DB::commit();
            return redirect()->route('roles.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e->getMessage();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $role=$this->repository->getById($id,relations:['permissions']);
       $permissions=$this->permissionRepository->getAll();
        return view('dashboard.site.roles.edit', compact('role','permissions'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $data=$request->except('permissions');
            $data['name']=str_replace(' ','-',strtolower($data['display_name_en']));
            $role = update_model($this->repository, $id, $data, true);
            $role->permissions()->sync($request->permissions);
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
            $role=$this->repository->getById($id);
            $role->permissions()->detach();
            delete_model($this->repository, $id);
            DB::commit();
            return redirect()->route('roles.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function mangers($id)
    {
        $role=$this->repository->getById($id,relations:['managers']);
        return view('dashboard.site.managers.index', compact('role'));
    }
}
