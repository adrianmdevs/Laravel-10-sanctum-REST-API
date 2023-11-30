<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Enrollment;
use App\Member;
use App\Payment;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{
    public function index($id)
    {
        $member = Member::find($id);
        $courses = Course::all();
        return view('admin.enroll.index')->with(compact('member', 'courses'));
    }

    public function enroll(Request $request, $id)
    {
        $this->validate($request, [
            'mpesa_ref_no' => 'required',
            'unit_id' => 'required',
        ]);
        //dd($request->all());
        //--- Enroll Learner --//
        $rows = count($request->unit_id);
        for ($j = 0; $j < $rows; $j++) {
            Enrollment::create([
                'member_id' => $request->member_id,
                'unit_id' => $request->unit_id[$j]
            ]);
        }
        //--- End Enrolling Learner --//
        //--- Start  Unit(s) Payments --//
        $arr = [];
        foreach ($request->unit_id as $item) {
            $arr[] = [
                'member_id' => $request->member_id,
                'mpesa_ref_no' => $request->mpesa_ref_no,
                'unit_id' => $item,
                'amount' => Unit::find($item)->price,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
//dd($arr);
        Payment::insert($arr);
        //--- End Unit(s) Payments --//


        return redirect()->back()->with('success', 'Learner has been enrolled to the unit(s).');
    }

    public function units(Request $request, $id)
    {
        $member = Member::find($request->member_id);
        $enrollments = $member->enrollments()->pluck('unit_id');
        $course = Course::find($id);
        $units = $course->units()->whereNotIn('id', $enrollments)->get();
        return response()->json($units);
    }

    public function course_units($id)
    {
        $member = Member::find($id);
        $enrollments = $member->enrollments()->get();
        //dd($enrollments);
        return view('admin.enroll.units')->with(compact('member', 'enrollments'));
    }

    public function delete($id)
    {
        $enrollment = Enrollment::find($id);
        $enrollment->delete();
        return redirect()->back()->with('info', 'Learner has been de-registered from the unit');
    }
}
