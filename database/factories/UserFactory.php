<?php

namespace Database\Factories;

use App\Models\EducationalStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'teacher',
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '123123123',
            'phone' => $this->faker->phoneNumber,
            'image' => $this->faker->imageUrl(),
            'cv' => $this->faker->url,
            'is_active' => true,
        ];
    }

//    public function definition(): array
//    {
//        $educationalStage = EducationalStage::query()->inRandomOrder()->first()->id;
//
//        return [
//            'type' => 'student',
//            'educational_stage_id' => $educationalStage,
//            'name' => $this->faker->name,
//            'email' => $this->faker->unique()->safeEmail,
//            'password' => '123123123',
//            'phone' => $this->faker->phoneNumber,
//            'image' => $this->faker->imageUrl(),
//            'cv' => $this->faker->url,
//            'is_active' => true,
//        ];
//    }
}
