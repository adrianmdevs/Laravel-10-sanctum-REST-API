<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function create()
    {
        // Allow teachers to create new students
        return view('students.create');
    }

    public function index()
    {
        // Allow teachers to view the list of all students
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function show(Teacher $teacher)
    {
        // Check if the logged-in user is a teacher and is the same as the requested teacher
        if (Auth::user()->isTeacher() && Auth::user()->id === $teacher->id)
         {
            return view('teachers.show', compact('teacher'));
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }

    public function edit(Teacher $teacher)
    {
        // Check if the logged-in user is a teacher and is the same as the requested teacher
        if (Auth::user()->isTeacher() && Auth::user()->id === $teacher->id) {
            return view('teachers.edit', compact('teacher'));
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }

    public function update(Request $request, Teacher $teacher)
    {
        // Check if the logged-in user is a teacher and is the same as the requested teacher
        if (Auth::user()->isTeacher() && Auth::user()->id === $teacher->id) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            ]);

            $teacher->update($request->all());

            return redirect()->route('teachers.show', $teacher->id)
                ->with('success', 'Teacher details updated successfully');
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }
}
