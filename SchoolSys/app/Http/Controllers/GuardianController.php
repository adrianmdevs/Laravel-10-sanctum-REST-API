<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    public function show(Guardian $guardian, Student $student)
    {
        // Allow guardians to view details of their own student(s)
        if (Auth::user()->id === $guardian->id && $student->guardians->contains(Auth::user())) {
            return view('students.show', compact('student'));
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }

    public function edit(Guardian $guardian)
    {
        // Check if the logged-in user is the guardian
        if (Auth::user()->id === $guardian->id) {
            return view('guardians.edit', compact('guardian'));
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }

    public function update(Request $request, Guardian $guardian)
    {
        // Check if the logged-in user is the guardian
        if (Auth::user()->id === $guardian->id) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:guardians,email,' . $guardian->id,
            ]);

            $guardian->update($request->all());

            return redirect()->route('guardians.show', [$guardian, $guardian->student])
                ->with('success', 'Guardian details updated successfully');
        }

        // Redirect unauthorized access
        return redirect()->route('home')->with('error', 'Unauthorized');
    }
}
