<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\Classs;

class AttendanceController extends Controller
{
    public function create()
    {
        // Display a form to track attendance for a class;
        $teachers = Teacher::all();
        $classes = Classs::all();

        return view('attendance.create', compact('teachers', 'classes'));
    }
    // Store the new attendance instance;

    public function store(Request $request)
    {
        // Validating the request;
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'attendance_date' => 'required|date',
            'students' => 'required|array',
        ]);

        // Checking  if the logged-in user is a teacher (assuming the appropriate roles are set);

        if (auth()->user()->isTeacher()) {
        // Track attendance for each selected student;

            foreach ($request->input('students') as $studentId) {
                Attendance::create([
                    'teacher_id' => $request->input('teacher_id'),
                    'class_id' => $request->input('class_id'),
                    'student_id' => $studentId,
                    'attendance_date' => $request->input('attendance_date'),
                    'is_present' => true, // Actual attendance status can be set here//
                ]);
            }

            return redirect()->route('classses.show', $request->input('class_id'))
                ->with('success', 'Attendance tracked successfully');
        } else {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
    }
}
