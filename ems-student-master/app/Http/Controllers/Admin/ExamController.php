<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 1)->get();
        //$units = Unit::where('status', 1)->get();
        return view('admin.exams.index')->with(compact('courses'));
    }
    public function get_units(Request $request, $id){
            $course = Course::find($id);
            $units = $course->units()->where('status',1)->latest()->get();
            return response()->json($units);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'unit_id' => 'required',
            'question' => 'required',
            'correct_answer' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
        ]);
       // dd($request->all());
        try {
            Question::create(array_merge($request->all()));
            return redirect()->back()->with('success', 'Question has been saved!');
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during submission, Please try again.');
        }

    }
}
