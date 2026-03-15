<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Response;

class CourseController extends Controller
{
    /**
     * GET ALL COURSES — Para sa dropdown sa Add/Edit Student modal
     */
    public function index()
    {
        try {
            $courses = Course::orderBy('course_name', 'asc')->get(['id', 'course_name']);
            return Response::json($courses, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}