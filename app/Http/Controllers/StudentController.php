<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * 1. GET ALL STUDENTS
     */
    public function index()
    {
        try {
            $students = Student::with('course')->latest()->get();
            return Response::json($students, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * 2. STORE NEW STUDENT
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email|unique:students,email',
                'gender'     => 'required|string',
                'course_id'  => 'required|exists:courses,id',
            ]);

            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()], 422);
            }

            $student = Student::create($request->all());
            return Response::json($student->load('course'), 201);

        } catch (\Exception $e) {
            return Response::json(['message' => 'Add Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return Response::json(['message' => 'Student not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email|unique:students,email,' . $id,
                'gender'     => 'required|string',
                'course_id'  => 'required|exists:courses,id',
            ]);

            if ($validator->fails()) {
                return Response::json(['errors' => $validator->errors()], 422);
            }

            $student->update($request->all());
            return Response::json($student->load('course'), 200);

        } catch (\Exception $e) {
            return Response::json(['message' => 'Update Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * 4. DELETE STUDENT
     */
    public function destroy($id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return Response::json(['message' => 'Student not found'], 404);
            }

            $student->delete();
            return Response::json(['message' => 'Student deleted successfully'], 200);

        } catch (\Exception $e) {
            return Response::json(['message' => 'Delete Error: ' . $e->getMessage()], 500);
        }
    }
}