<?php

namespace App\Http\Controllers\Member;

use App\Member;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index($id)
    {
        $unit = Unit::find($id);
        $qids = $unit->questions()->latest()->get()->pluck('id');
        $answers = Member::find(Auth::user()->member->id)->answers()->whereIn('question_id', $qids)->get();
       // dd($answers);
        $scores = $answers->map(function ($item, $key) {
            return [
                'question' => $item->question->question,
                'member_answer' => $item->member_answer,
                'correct' => ($item->question->correct_answer == $item->member_answer) ? 1 : 0,
            ];
        });
        //dd($scores);
        return view('member.results')->with(compact('scores'));
    }
}
