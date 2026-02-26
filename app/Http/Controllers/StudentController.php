<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    /**
     * Return all students.
     */
    public function index(): JsonResponse
    {
        $students = Student::latest()->get();

        return response()->json([
            'message' => 'Students retrieved successfully.',
            'data'    => $students,
        ]);
    }

    /**
     * Store a new student.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return response()->json([
            'message' => 'Student created successfully.',
            'data'    => $student,
        ], 201);
    }

    /**
     * Return a single student.
     */
    public function show(Student $student): JsonResponse
    {
        return response()->json([
            'message' => 'Student retrieved successfully.',
            'data'    => $student,
        ]);
    }

    /**
     * Update an existing student.
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $student->update($request->validated());

        return response()->json([
            'message' => 'Student updated successfully.',
            'data'    => $student,
        ]);
    }

    /**
     * Delete a student.
     */
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully.',
        ]);
    }
}
