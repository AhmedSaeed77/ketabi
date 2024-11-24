<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectUser>
 */
class SubjectUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjectId = Subject::inRandomOrder()->first()->id;
        $teacherId = User::inRandomOrder()->isTeacher()->first()->id;

        return [
            'subject_id' => $subjectId,
            'user_id' => $teacherId,
        ];
    }
}
