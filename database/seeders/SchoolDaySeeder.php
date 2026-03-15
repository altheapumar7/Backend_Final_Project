<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SchoolDaySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('school_days')->truncate();

        $records = [];
        $start = Carbon::create(2024, 6, 3);
        $end   = Carbon::create(2025, 3, 28);

        
        $holidays = [
            '2024-06-12' => 'Independence Day',
            '2024-08-21' => 'Ninoy Aquino Day',
            '2024-08-26' => 'National Heroes Day',
            '2024-11-01' => 'All Saints Day',
            '2024-11-02' => 'All Souls Day',
            '2024-11-30' => 'Bonifacio Day',
            '2024-12-08' => 'Immaculate Conception',
            '2024-12-24' => 'Christmas Eve',
            '2024-12-25' => 'Christmas Day',
            '2024-12-30' => 'Rizal Day',
            '2024-12-31' => "New Year's Eve",
            '2025-01-01' => "New Year's Day",
            '2025-02-25' => 'EDSA People Power Anniversary',
        ];

      
        $events = [
            '2024-06-03' => 'First Day of Classes',
            '2024-07-15' => 'Midterm Examinations',
            '2024-07-19' => 'Midterm Examinations',
            '2024-08-05' => 'Foundation Day Celebration',
            '2024-09-02' => 'Preliminary Examinations',
            '2024-09-06' => 'Preliminary Examinations',
            '2024-10-14' => 'Semi-Final Examinations',
            '2024-10-18' => 'Semi-Final Examinations',
            '2024-11-11' => 'Recognition Day',
            '2024-11-25' => 'Final Examinations',
            '2024-11-29' => 'Final Examinations',
            '2024-12-13' => 'Christmas Party / Last Day (1st Sem)',
            '2025-01-06' => 'Start of Second Semester',
            '2025-02-10' => 'Midterm Examinations (2nd Sem)',
            '2025-02-14' => 'Midterm Examinations (2nd Sem)',
            '2025-03-10' => 'Final Examinations (2nd Sem)',
            '2025-03-14' => 'Final Examinations (2nd Sem)',
            '2025-03-28' => 'Graduation / Last Day of Classes',
        ];

       
        $breakStart = Carbon::create(2024, 12, 14);
        $breakEnd   = Carbon::create(2025, 1, 5);

        $current = $start->copy();

        while ($current->lte($end)) {
            $dateStr = $current->toDateString();

           
            if ($current->isWeekend()) {
                $current->addDay();
                continue;
            }

            $isHoliday = array_key_exists($dateStr, $holidays);
            $isEvent   = array_key_exists($dateStr, $events);
            $isBreak   = $current->between($breakStart, $breakEnd);

            if ($isHoliday) {
                $type            = 'holiday';
                $description     = $holidays[$dateStr];
                $attendance_count = 0;

            } elseif ($isBreak) {
                $type            = 'holiday';
                $description     = 'Christmas / New Year Break';
                $attendance_count = 0;

            } elseif ($isEvent) {
               
                $type            = 'event';
                $description     = $events[$dateStr];
                $attendance_count = rand(470, 500);

            } else {
                
                $type            = 'regular';
                $description     = null;
                $attendance_count = rand(425, 495);
            }

            $records[] = [
                'date'             => $dateStr,
                'type'             => $type,
                'attendance_count' => $attendance_count,
                'description'      => $description,
                'created_at'       => now(),
                'updated_at'       => now(),
            ];

            $current->addDay();
        }

        foreach (array_chunk($records, 100) as $chunk) {
            DB::table('school_days')->insert($chunk);
        }

        $this->command->info('SchoolDaySeeder: ' . count($records) . ' records seeded successfully.');
    }
}