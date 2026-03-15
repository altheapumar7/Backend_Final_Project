<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'course_name' => fake()->randomElement(['BSIT', 'BSCS', 'BSEE', 'BSBA', 'BSED']),
        'department' => fake()->randomElement(['DCE', 'DEE', 'Business', 'Education']),
    ];
}
}
