<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student> 
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $randomDate = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'birthdate' => fake()->date('Y-m-d', '2005-01-01'),
            'enrollment_date' => $randomDate, 
            'created_at' => $randomDate, 
            'updated_at' => $randomDate,
        ];
    }
}