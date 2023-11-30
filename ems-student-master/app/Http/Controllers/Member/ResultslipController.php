<?php

namespace App\Http\Controllers\Member;

use App\Course;
use App\Http\Repos\Learner;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as CPDF;
use App\Http\Controllers\Controller;

class ResultslipController extends Controller
{
    public function index()
    {
        $member = Learner::user();
        $enrollments = $member->enrollments()->where('status', 1)->get();
        //dd($enrollments);
        $units = $enrollments->map(function ($item, $key) {
            return [
                'course_id' => $item->unit->course->id,
                'course' => $item->unit->course->name,
                'course_description' => $item->unit->course->description,
            ];
        })->unique('course_id');
        $courses = json_decode(json_encode($units), false);
        // dd($courses);
        return view('member.scores.result-slip')->with(compact('courses'));
    }

    public function show($id)
    {
        $member = Learner::user();
        $course = Course::find($id);
        $member_units = $member->enrollments()->get()->pluck('unit_id');
        $units = Course::find($id)->units()->whereIn('id', $member_units)->has('questions')
            ->with('questions.answer')
            ->get()->transform(function ($item, $key) {
                return [
                    'id' => $item->id,
                    'unit' => $item->name,
                    'total_questions' => $item->questions()->get()->count(),
                    'correct_questions' => $item->questions()->has('answer')->get()->transform(function ($value, $index) {
                        return [
                            'correct' => ($value->correct_answer == $value->answer->member_answer) ? 1 : 0,
                        ];
                    })->sum('correct'),
                ];
            })->map(function ($item, $key) {
                return [
                    'id' => $item['id'],
                    'unit' => $item['unit'],
                    'score' => round(($item['correct_questions'] / $item['total_questions']) * 100, 0),
                ];
            });
        if ($units->isEmpty()) {
            return redirect()->back()->with('warning', 'You have not done any exam(s) in the units you enrolled!');
        }
        // dd($units);
        return view('member.scores.slip-show')->with(compact('units', 'course'));
    }

    public function download($id)
    {
        $member = Learner::user();
        $course = Course::find($id);
        $member_units = $member->enrollments()->get()->pluck('unit_id');
        $units = Course::find($id)->units()->whereIn('id', $member_units)->has('questions')
            ->with('questions.answer')
            ->get()->transform(function ($item, $key) {
                return [
                    'id' => $item->id,
                    'unit' => $item->name,
                    'total_questions' => $item->questions()->get()->count(),
                    'correct_questions' => $item->questions()->has('answer')->get()->transform(function ($value, $index) {
                        return [
                            'correct' => ($value->correct_answer == $value->answer->member_answer) ? 1 : 0,
                        ];
                    })->sum('correct'),
                ];
            })->map(function ($item, $key) {
                return [
                    'id' => $item['id'],
                    'unit' => $item['unit'],
                    'score' => round(($item['correct_questions'] / $item['total_questions']) * 100, 0),
                ];
            });
        if ($units->isEmpty()) {
            return redirect()->back()->with('warning', 'You have not done any exam(s) in the units you enrolled!');
        }
        // dd($units);
        $pdf = CPDF::loadView('member.scores.slip-download', [
            'course' => $course,
            'units' => $units,
            'member' => $member,
        ], [], ['format' => 'A4-P']);
        return $pdf->download("{$member->fname}__Result_slip.pdf");

    }
}
