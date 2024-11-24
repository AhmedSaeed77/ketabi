<?php

namespace App\Http\Services\Dashboard\User;

use App\Http\Requests\Dashboard\User\UserRequest;
use App\Http\Services\Mutual\FileManagerService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected FileManagerService $fileManagerService;


    public function __construct(
        FileManagerService $fileManagerService,
    ) {
        $this->fileManagerService = $fileManagerService;
    }

    public function store(UserRequest $request)
    {


        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request->is_active == 'on';
            if ($request->image !== null) {
                $data['image'] = $this->fileManagerService->handle('image', 'profiles/users/images');
            }
            $this->userRepository->create($data);
            DB::commit();
            return redirect()->route('users.index')->with(['success' => __('messages.created successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CATCH: '. $e);
            return redirect()->route('users.create')->with(['error' => $e]);
        }
    }

    public function update(UserRequest $request, string $id)
    {
        $user = $this->userRepository->getById($id);
        DB::beginTransaction();
        try {
            $data = $request->validated();

            if ($request->image !== null) {
                $data['image'] = $this->fileManagerService->handle('image', 'profiles/users/images', $user->image);
            }

            if ($data['password'] == null) {
                unset($data['password']);
            }

            $data['is_active'] = $request->is_active == 'on';


            $this->userRepository->update($id, $data);
            DB::commit();
            return redirect()->route('users.index')->with(['success' => __('messages.updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.edit', [$id])->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy(string $id)
    {
        $user = $this->userRepository->getById($id);
        // Gate::authorize('delete-User',$User);
        DB::beginTransaction();
        try {
            $this->userRepository->delete($id, ['image']);
            DB::commit();
            return redirect()->route('users.index',)->with(['success' => __('messages.deleted successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CATCH: '. $e);
            return redirect()->route('users.index',)->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
