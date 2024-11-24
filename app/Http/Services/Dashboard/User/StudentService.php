<?php

namespace App\Http\Services\Dashboard\User;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class StudentService
{
    use FileManager;
    public function __construct(private UserRepositoryInterface             $repository,
                                private EducationalStageRepositoryInterface $educationalStageRepository,
                                private SubjectRepositoryInterface          $subjectRepository,
                                private FileManagerService                  $fileManager)
    {

    }

    public function index()
    {
        $users = $this->repository->getStudents();
        return view('dashboard.site.students.index', compact('users'));
    }

    public function create()
    {
        $educational_stages = $this->educationalStageRepository->getAll();
        return view('dashboard.site.students.create', compact( 'educational_stages'));
    }
    public function show($id)
    {
        $user = $this->repository->getById($id, relations: ['studentStage']);
        return view('dashboard.site.students.show', compact( 'user'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('subjects', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;
            if ($request->image !== null)
                $data['image'] = $this->fileManager->handle('image', 'users/images');
            store_model($this->repository, $data);
            DB::commit();
            return redirect()->route('students.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $user = $this->repository->getById($id, relations: ['subjects', 'educationalStages']);
        $educational_stages = $this->educationalStageRepository->getAll();
        return view('dashboard.site.students.edit', compact('user', 'educational_stages'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->getById($id);
            $data = $request->except('password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;
            if ($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'users/images',$user->image);
            }
            update_model($this->repository, $id, $data);
            DB::commit();
            return redirect()->route('students.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->getById($id);
            if($user->image)
                $this->deleteFile($user->image);
            delete_model($this->repository, $id);
            DB::commit();
            return redirect()->route('students.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function toggle()
    {
        try {
            update_model($this->repository, request('itemId'), ['is_active' => request('status')]);
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
