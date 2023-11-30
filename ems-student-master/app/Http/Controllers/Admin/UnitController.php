<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        $courses = $courses = Course::where('status', 1)->get();
        return view('admin.units')->with(compact('units', 'courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'unit_code' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Whoops! An error occured during sign in, fill all required fields!');
        }
        try {
            Unit::create(array_merge($request->all()));
            return redirect()->back()->with('success', 'Unit has been created');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during submission, Please try again.');
        }
    }

    // ---------------- View Unit ----------
    public function show($id)
    {
        $courses = Course::where('status', 1)->get();
        $unit = Unit::find($id);
        return view('admin.view-unit')->with(compact('unit', 'courses'));
    }

    // ---------------- Update Unit ----------
    public function update(Request $request, $id)
    {
        //  dd($request->all());
        Unit::findOrFail($id)->update(array_merge($request->except(['id'])));
        return redirect()->back()->with('info', 'Unit has been updated!');
    }

    // ---------------- Unit Learners ----------
    public function members($id)
    {
        $unit = Unit::find($id);
        $members = $unit->enrollments()->get();
        // dd($members);
        return view('admin.units.index')->with(compact('unit', 'members'));
    }

    // ---------------- Unit Exams----------
    public function exams($id)
    {
        $unit = Unit::find($id);
        $exams = $unit->questions()->latest()->paginate(4);
        // dd($exams);
        return view('admin.units.exams')->with(compact('unit', 'exams'));
    }

    // ---------------- View Course Units ----------
    public function units($id)
    {
        $course = Course::find($id);
        $units = $course->units()->get();
        return view('admin.course-units')->with(compact('course', 'units'));
    }

    public function toggle_status($id)
    {
        try {
            $status = Unit::where('id', $id)->first()->status;
            if ($status == 1) {
                Unit::where('id', $id)->update(['status' => 0]);
            } else {
                Unit::where('id', $id)->update(['status' => 1]);
            }
            return redirect()->back()->with('info', 'Unit status has been updated!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong when updating status, Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $delete = Unit::find($id);
            $delete->delete();
            return redirect()->back()->with('info', 'Unit has been deleted!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during deletion, Please try again.');
        }
    }
}
