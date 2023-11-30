<?php

namespace App\Http\Controllers\Member;

use App\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $member_id = $request->member_id;
        $question_id = $request->question_id;
        $answers = collect($request->except(['_token', 'question_id', 'member_id']))->flatten()->toArray();
        //dd($question_id);
        $count = collect($question_id)->count();
        // dd($count);
        try {
            for ($i = 0; $i < $count; $i++) {
                Answer::create([
                    'member_id' => $member_id,
                    'question_id' => $question_id[$i],
                    'member_answer' => $answers[$i],

                ]);
            }
            return redirect()->back()->with('success', 'Answers have been submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong during submission!');
        }

    }
}
