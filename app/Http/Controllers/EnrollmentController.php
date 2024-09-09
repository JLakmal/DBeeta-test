<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class EnrollmentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $enrollment = Enrollment::firstOrCreate([
            'course_id' => $course->id,
            'student_id' => Auth::id(), // Use the Auth facade
        ]);

        return response()->json(['status' => 'enrolled']);
    }
}
