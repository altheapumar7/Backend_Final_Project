<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use Faker\Factory as Faker;
use Carbon\Carbon; // Importa ang Carbon para sa petsa

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $courseIds = Course::pluck('id')->toArray();

        if (empty($courseIds)) {
            $this->command->error('Error: Paghimo sa una og CourseSeeder!');
            return;
        }

        $students = [];
        
        for ($i = 0; $i < 500; $i++) {
            $randomDate = $faker->dateTimeBetween('-6 months', 'now');

            $students[] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'course_id' => $faker->randomElement($courseIds),
                'created_at' => $randomDate, 
                'updated_at' => $randomDate,
            ];

            if (count($students) == 100) {
                Student::insert($students);
                $students = [];
            }
        }
        
        if (!empty($students)) {
            Student::insert($students);
        }
        
        $this->command->info('Successfully generated 500 students with randomized dates!');
    }
}