<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses')->with(compact('courses'));
    }
// ---------------- Store Course ----------
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'course_code' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Whoops! An error occured during sign in, fill all required fields!');
        }
        try {
            Course::create(array_merge($request->all()));
            return redirect()->back()->with('success', 'Course has been created');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during submission, Please try again.');
        }
    }

    // ---------------- View Course ----------
    public function show($id)
    {
        $course = Course::find($id);
        return view('admin.view-course')->with(compact('course'));
    }
    public function update(Request $request,$id)
    {
        Course::findOrFail($id)->update(array_merge($request->except(['id'])));
        return redirect()->back()->with('info','Course has been updated!');
    }
    // ---------------- View Course Units ----------
    public function units($id)
    {
        $course = Course::find($id);
        $units=$course->units()->get();
        return view('admin.course-units')->with(compact('course','units'));
    }

// ---------------- Toggle status ----------
    public function toggle_status($id)
    {
        try {
            $status = Course::where('id', $id)->first()->status;
            if ($status == 1) {
                Course::where('id', $id)->update(['status' => 0]);
            } else {
                Course::where('id', $id)->update(['status' => 1]);
            }
            return redirect()->back()->with('info', 'Course status has been updated!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong when updating status, Please try again.');
        }
    }

// ---------------- Delete Course ----------
    public function destroy($id)
    {
        try {
            $delete = Course::find($id);
            $delete->delete();
            return redirect()->back()->with('info', 'Course has been deleted!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during deletion, Please try again.');
        }
    }

}
