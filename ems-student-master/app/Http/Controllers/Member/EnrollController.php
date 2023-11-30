<?php

namespace App\Http\Controllers\Member;

use App\Course;
use App\Course_member;
use App\Enrollment;
use App\Http\Repos\Learner;
use App\Payment;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{
    public function index()
    {
        $member =  $member = Learner::user();
        $courses = Course::all();
        return view('member.enroll')->with(compact('member', 'courses'));
    }

    public function enroll(Request $request)
    {
        $this->validate($request, [
            'mpesa_ref_no' => 'required',
            'unit_id' => 'required',
        ]);
        $id = Auth::user()->member->id;
        $course=Course::find($request->course_id);
//          $course_member=Course_member::where('member_id',$request->member_id)->first();
//        if (collect($course_member)->isEmpty()) {
//           dd('mee empty');
//        }
//        else{
//            dd('mee not empty');
//        }
       // dd($request->all());
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
        $course_member=Course_member::where(['member_id'=>$request->member_id,'course_id'=>$course->id])->first();
        if (collect($course_member)->isEmpty()) {
         Course_member::create([
                'course_id'=>$course->id,
                'member_id' => $request->member_id,
                'cert_no' => $course->c_no,
            ]);
            $course->update(['c_no'=>$course->c_no+1]);
        }
        else{
            $course->update(['c_no' => $course->c_no]);
        }

//dd($arr);
        Payment::insert($arr);
        //--- End Unit(s) Payments --//
        return redirect()->back()->with("enrolled", '');
    }

}
