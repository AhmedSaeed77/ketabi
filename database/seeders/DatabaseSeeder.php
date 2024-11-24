<?php

namespace Database\Seeders;

use App\Models\EducationalStage;
use App\Models\EducationalStageUser;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        EducationalStage::factory(6)->create();
//
//        Subject::factory(50)->create();
//
//        User::factory(100)->create(); // for teachers and students
//
//        SubjectUser::factory(100)->create(); // for teachers
//
//        EducationalStageUser::factory(100)->create(); // for teachers
        $this->call(LaratrustSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(InfosSeeder::class);
    }
}
