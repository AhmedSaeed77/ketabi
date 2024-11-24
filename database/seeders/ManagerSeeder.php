<?php

namespace Database\Seeders;

use App\Models\EducationalStage;
use App\Models\Manager;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = Manager::query()->firstOrCreate(
            [
                'email' => 'admin@madrasa.com',
            ],
            [
                'name' => 'Super Admin',
                'phone' => fake()->phoneNumber(),
                'password' => '123123123',

                'is_active' => true,
            ]
        );

        $manager->addRole('super-admin');


//        $manager = Manager::query()->createOrFirst(
//            [
//                'email' => 'teacher@madrasa.com',
//            ],
//            [
//                'name' => 'User 1',
//                'phone' => fake()->phoneNumber(),
//                'password' => '123123123',
//                'is_best_teacher' => true,
//                'is_active' => true,
//            ]);
//
//        $manager->addRole('teacher');
//
//        $manager->educationalStages()->sync(EducationalStage::first());
//        $manager->subjects()->sync(Subject::first());
    }
}
