<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $coursesData = [
            ['name' => 'BSIT', 'dept' => 'CCS'], ['name' => 'BSCS', 'dept' => 'CCS'],
            ['name' => 'BSIS', 'dept' => 'CCS'], ['name' => 'BSCE', 'dept' => 'COE'],
            ['name' => 'BSEE', 'dept' => 'COE'], ['name' => 'BSME', 'dept' => 'COE'],
            ['name' => 'BSArch', 'dept' => 'COE'], ['name' => 'BSA', 'dept' => 'CBA'],
            ['name' => 'BSBA', 'dept' => 'CBA'], ['name' => 'BSHM', 'dept' => 'CHM'],
            ['name' => 'BSTM', 'dept' => 'CHM'], ['name' => 'BSED', 'dept' => 'CTED'],
            ['name' => 'BEED', 'dept' => 'CTED'], ['name' => 'BSPsych', 'dept' => 'CAS'],
            ['name' => 'BSCrim', 'dept' => 'CCJE'], ['name' => 'BSN', 'dept' => 'CON'],
            ['name' => 'BSMT', 'dept' => 'CON'], ['name' => 'BSPharma', 'dept' => 'CON'],
            ['name' => 'BSBio', 'dept' => 'CAS'], ['name' => 'BSMath', 'dept' => 'CAS'],
        ];

        foreach ($coursesData as $course) {
            Course::updateOrCreate(
                ['course_name' => $course['name']],
                ['department' => $course['dept']]
            );
        }
    }
}