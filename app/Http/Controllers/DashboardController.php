<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\SchoolDay;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            
            $enrollmentTrends = Student::select(
                DB::raw("DATE_FORMAT(created_at, '%b') as month"), 
                DB::raw('count(*) as count'),
                DB::raw('MIN(created_at) as sort_date')
            )
            ->groupBy('month')
            ->orderBy('sort_date', 'asc')
            ->get();

            $courseDistribution = Course::withCount('students')
                ->orderBy('students_count', 'desc')
                ->take(10) 
                ->get()
                ->map(function($course) {
                    return [
                        'course_name' => $course->course_name,
                        'count' => $course->students_count
                    ];
                });

            $attendanceData = SchoolDay::orderBy('date', 'asc')
                ->select('date', 'attendance_count', 'type', 'description')
                ->get();

            $upcomingEvents = SchoolDay::whereIn('type', ['holiday', 'event'])
                ->where('date', '>=', now()->format('Y-m-d')) 
                ->orderBy('date', 'asc')
                ->limit(5)
                ->get();

            $stats = [
                'total_students' => Student::count(),
                'total_courses' => Course::count(),
                'male_count' => Student::where('gender', 'Male')->count(),
                'female_count' => Student::where('gender', 'Female')->count(),
            ];

           
            $recentStudents = Student::with('course')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            return response()->json([
                'success' => true,
                'stats' => $stats,
                'enrollmentTrends' => $enrollmentTrends,
                'courseDistribution' => $courseDistribution,
                'attendance' => $attendanceData,
                'upcomingEvents' => $upcomingEvents, 
                'recentStudents' => $recentStudents
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching dashboard data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}