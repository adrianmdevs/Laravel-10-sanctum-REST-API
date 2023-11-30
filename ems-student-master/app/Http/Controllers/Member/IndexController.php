<?php

namespace App\Http\Controllers\Member;

use App\Answer;
use App\Book;
use App\Member;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        $enrollments = $member->enrollments()->where('status', 1)->get()->count();
        // dd($enrollments);
        return view('admin.index')->with(compact('member', 'enrollments'));
    }

    public function update(Request $request)
    {
        $id = Auth::user()->member->id;
        Member::findOrFail($id)->update(array_merge($request->except(['id'])));
        return redirect()->back()->with('info', 'Member details have been updated!');
    }

    public function units()
    {
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        $enrollments = $member->enrollments()->where('status', 1)->get();
        //dd($enrollments);
        return view('member.units')->with(compact('member', 'enrollments'));
    }

    public function payments()
    {
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        $payments = $member->payments()->get();
        //dd($payments);
        return view('member.payments')->with(compact('member', 'payments'));
    }

    public function certificates()
    {
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        $enrollments = $member->enrollments()->where('status', 1)->get();
        //dd($enrollments);
        return view('member.transcript')->with(compact('member', 'enrollments'));
    }

    public function books($id)
    {
        $hostname = $_SERVER['HTTP_HOST'];
        $unit = Unit::find($id);
        $documents = $unit->documents()->latest()->get();
        if ($documents->isEmpty()) {
            return redirect()->back()->with('info', 'No  course materials available for that unit!');
        } else {
            return view('member.books')->with(compact('documents', 'unit', 'hostname'));
        }
    }

    // ---------------- Unit Exams----------
    public function exams($id)
    {
        $unit = Unit::find($id);
//        $exams = $unit->questions()->latest()->paginate(2);
        $exams = $unit->questions()->latest()->get();
        //dd($exams);
        $qids = $unit->questions()->latest()->get()->pluck('id');
        $answers = Member::find(Auth::user()->member->id)->answers()->whereIn('question_id', $qids)->get();
        $scores = $answers->map(function ($item, $key) {
            return [
                'question' => $item->question->question,
                'member_answer' => $item->member_answer,
                'correct' => ($item->question->correct_answer == $item->member_answer) ? 1 : 0,
            ];
        });
        if ($exams->isEmpty() && $scores->isEmpty()) {
            return redirect()->back()->with('info', 'No exams found in the system for that unit!');
        }
        elseif($exams->isNotEmpty() && $scores->isEmpty()){
            return view('member.exams')->with(compact('unit', 'exams', 'answers', 'scores'));
        } else {
            //dd($scores);
            // dd($exams);
            return view('member.exams')->with(compact('unit', 'exams', 'answers', 'scores'));
        }

    }

    public function read($id)
    {
        //dd($id);
        $book = Book::find($id);
        // dd($book);
        return view('member.read')->with(compact('book'));
    }
}
