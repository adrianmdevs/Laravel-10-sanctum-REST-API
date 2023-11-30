<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classs;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function create()
    {
        // Displaying a form to enroll a student in a class;
        $teachers = Teacher::all();
        $students = Student::all();
        $classes = Classs::all();

        return view('enrollment.create', compact('teachers', 'students', 'classes'));
    }

    public function store(Request $request)
    {
        // Validating the request;
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'required|exists:students,id',
            'classs_id' => 'required|exists:classes,id',
        ]);

        // Checking if the logged-in user is a teacher (assuming the appropriate roles are set)
        if (auth()->user()->isTeacher()) {
            // Enroll the student in the class
            Enrollment::create([
                'teacher_id' => $request->input('teacher_id'),
                'student_id' => $request->input('student_id'),
                'class_id' => $request->input('class_id'),
            ]);

            return redirect()->route('students.show', $request->input('student_id'))
                ->with('success', 'Student enrolled successfully');
        } else {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
    }
}
