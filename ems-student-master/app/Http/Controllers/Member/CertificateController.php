<?php

namespace App\Http\Controllers\Member;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repos\Learner;
use niklasravnsborg\LaravelPdf\Facades\Pdf as CPDF;

class CertificateController extends Controller
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
        return view('member.scores.certificate')->with(compact('courses'));
    }

    public function print_cert()
    {
        $member = Learner::user();
        // dd($member);
        $enrollments = $member->enrollments()->where('status', 1)->get();
        $enrollments->transform(function ($item, $key) {
            return [
                'unit' => $item->unit->name,
                'course_id' => $item->unit->course->id,
                'course' => $item->unit->course->name,
                'course_description' => $item->unit->course->description,
            ];
        });
        $cert=$member->certificates()->where('course_id',1)->first();
       // dd($cert);
        // dd($enrollments->groupBy('course_id'));
        $pdf = CPDF::loadView('member.scores.cert-pdf', ['cert'=>$cert, 'enrollment' =>$member->enrollments()->latest()->first()], [], ['format' => 'A4-L',]);

        return $pdf->stream("{$member->fname}__Certificate.pdf");
    }

    public function print_certificate($id)
    {
        $member = Learner::user();
        $course_units = Course::find($id)->units()->get()->pluck('id');
        $member_units = $member->enrollments()->get()->pluck('unit_id');
        if ($course_units->count() == $member_units->count()) {
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
                })->filter(function ($item) {
                    return ($item['score']) >= 50;
                });
            //dd($units);
            $cert=$member->certificates()->where('course_id',Course::find($id)->id)->first();
            if ($units->count() == $member_units->count()) {
                $pdf = CPDF::loadView('member.scores.cert-pdf', [
                    'data' => $member,
                    'course' => Course::find($id),
                    'cert'=>$cert,
                    'enrollment' => $member->enrollments()->latest()->first(),
                ], [], ['format' => 'A4-L']);
                return $pdf->download("{$member->fname}__Certificate.pdf");
            }
            return redirect()->back()->with('warning', 'You have not attained the minimum score required in all the units!');
        }
        return redirect()->back()->with('warning', 'You have not taken all the units in this Course!');
    }
}
