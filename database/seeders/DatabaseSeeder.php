<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CourseSeeder::class,      
            StudentSeeder::class,     
            SchoolDaySeeder::class,   
        ]);

        
        User::factory()->updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'System Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'), 
            ]
        );
        $this->command->info('------------------------------------------');
        $this->command->info('Database seeding completed successfully!');
        $this->command->info('Admin Account: admin / password123');
        $this->command->info('Total Students: ' . Student::count());
        $this->command->info('Total Courses: ' . Course::count());
        $this->command->info('------------------------------------------');
    }
}