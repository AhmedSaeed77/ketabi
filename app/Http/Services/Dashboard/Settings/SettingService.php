<?php

namespace App\Http\Services\Dashboard\Settings;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\ManagerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\update_model;

class SettingService
{
    public function __construct(private ManagerRepositoryInterface $repository, private FileManagerService $fileManagerService)
    {

    }

    public function edit($id)
    {
        $user = auth()->user();
        return view('dashboard.site.settings.edit', compact('user'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->getById($request->id);
            $data = $request->except('id', 'image');
            if ($request->image !== null)
                $data['image'] = $this->fileManagerService->handle('image', 'managers/images', $user->image);
            update_model($this->repository, $request->id, $data);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function updatePassword($request)
    {
        DB::beginTransaction();
        try {
            update_model($this->repository, auth()->id(), ['password' => $request->new_password]);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
