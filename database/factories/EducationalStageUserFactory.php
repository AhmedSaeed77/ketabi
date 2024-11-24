<?php

namespace Database\Factories;

use App\Models\EducationalStage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationalStageUser>
 */
class EducationalStageUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $educationalStageId = EducationalStage::inRandomOrder()->first()->id;
        $teacherId = User::inRandomOrder()->isTeacher()->first()->id;

        return [
            'educational_stage_id' => $educationalStageId,
            'user_id' => $teacherId,
        ];
    }
}
