<?php

namespace App\Http\Controllers\Reports;

use App\Course;
use App\Enrollment;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;

class CourseController extends Controller
{
    public function index()
    {
        $members = Enrollment::latest()->get();
        $courses = Course::where('status', 1)->get();
        return view('admin.reports.courses')->with(compact('members', 'courses'));
    }

    public function print_courses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'unit_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $start = $request->start_date;
        $end = date("Y-m-d", strtotime($request->end_date . "+1 day"));
        if ($request->unit_id == 'All') {
            $course = "All";
            $members = Enrollment::whereBetween('created_at', [$start, $end])->latest()->get();
        } else {
            $members = Enrollment::whereBetween('created_at', [$start, $end])->where('unit_id', $request->unit_id)->latest()->get();
            $course = Unit::find($request->unit_id)->name;
            // dd($members);
        }
        $hostname = $_SERVER['HTTP_HOST'];
        $pdf = PDF::loadView('admin.reports.courses-pdf',
            [
                'members' => $members,
                'start' => $start,
                'end' => $request->end_date,
                'course' => $course,
                'hostname' => $hostname
            ]
        )
            ->setPaper('a4', 'landscape');
        return $pdf->download("Course_Learners_report_{$start}_{$request->end_date}.pdf");
    }
}
