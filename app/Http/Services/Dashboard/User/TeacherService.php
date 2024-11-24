<?php

namespace App\Http\Services\Dashboard\User;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Repository\BankRepositoryInterface;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class TeacherService
{
    use FileManager;
    public function __construct(private UserRepositoryInterface             $repository,
                                private EducationalStageRepositoryInterface $educationalStageRepository,
                                private SubjectRepositoryInterface          $subjectRepository,
                                private FileManagerService                  $fileManager,
                                private BankRepositoryInterface $bankRepository)
    {

    }

    public function index()
    {
        $users = $this->repository->getTeachers();
        return view('dashboard.site.teachers.index', compact('users'));
    }

    public function create()
    {
        $educational_stages = $this->educationalStageRepository->getAll();
        $subjects = $this->subjectRepository->getAll();
        $banks=$this->bankRepository->getAll();
        return view('dashboard.site.teachers.create', compact('subjects', 'educational_stages','banks'));
    }
    public function show($id)
    {
        $user = $this->repository->getById($id, relations: ['subjects', 'educationalStages']);
        return view('dashboard.site.teachers.show', compact( 'user'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('subjects', 'stages', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;
            if ($request->image !== null)
                $data['image'] = $this->fileManager->handle('image', 'users/images');
            if ($request->cv !== null)
                $data['cv'] = $this->fileManager->upload('cv', 'users/cvs');
            $teacher = store_model($this->repository, $data, true);
            $teacher->subjects()->attach($request->subjects);
            $teacher->educationalStages()->attach($request->stages);
            DB::commit();
            return redirect()->route('teachers.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $user = $this->repository->getById($id, relations: ['subjects', 'educationalStages']);
        $educational_stages = $this->educationalStageRepository->getAll();
        $subjects = $this->subjectRepository->getAll();
        $banks=$this->bankRepository->getAll();
        return view('dashboard.site.teachers.edit', compact('user', 'educational_stages', 'subjects','banks'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->getById($id);
            $data = $request->except('subjects', 'stages', 'password_confirmation');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;
            if ($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'users/images',$user->image);
            }
            if ($request->cv !== null) {
                $data['cv'] = $this->fileManager->upload('cv', 'users/cvs',$user->cv);
            }
            $teacher = update_model($this->repository, $id, $data, true);
            $teacher->subjects()->sync($request->subjects);
            $teacher->educationalStages()->sync($request->stages);
            DB::commit();
            return redirect()->route('teachers.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
            DB::beginTransaction();
        try {
            $user = $this->repository->getById($id,relations: ['subjects', 'educationalStages']);
            if($user->image)
                $this->deleteFile($user->image);
            if($user->cv)
                $this->deleteFile($user->cv);
            $user->subjects()->detach();
            $user->educationalStages()->detach();
            delete_model($this->repository, $id);
            DB::commit();
            return redirect()->route('teachers.index')->with(['success' => __('messages.deleted_successfully')]);
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
