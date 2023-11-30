<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function show(Student $student)
    {
        // Allow the student to view their own details
        if (Auth::user()->id === $student->id) {
            return view('students.show', compact('student'));
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        // Allow the student to update their own details
        if (Auth::user()->id === $student->id) {
            $student->update($request->all());
            return redirect()->route('students.show', $student->id)->with('success', 'Student details updated successfully');
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }
}
