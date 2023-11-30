<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Member;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->get();
        $courses = Course::where('status', 1)->get();
        return view('admin.members')->with(compact('members', 'courses'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'nid' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Whoops! An error occured during sign in, fill all required fields!');
        }
        try {
            $user = User::create([
                'name' => $request->fname,
                'email' => $request->email,
                'password' => bcrypt($request->nid),
            ]);
            $user_id = $user->id;
            $request->request->add(['user_id' => $user_id]);
            Member::create(array_merge($request->all()));
            return redirect()->back()->with('success', 'Learner has been added');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during submission, Please try again.');
        }
    }


    // ---------------- View Member ----------
    public function show($id)
    {
        $member = Member::find($id);
        return view('admin.view-member')->with(compact('member'));
    }

    // ---------------- Update Member ----------
    public function update(Request $request, $id)
    {
        //  dd($request->all());
        Member::findOrFail($id)->update(array_merge($request->except(['id'])));
        return redirect()->back()->with('info', 'Member details have been updated!');
    }

    public function toggle_status($id)
    {
        try {
            $status = Member::where('id', $id)->first()->status;
            if ($status == 1) {
                Member::where('id', $id)->update(['status' => 0]);
            } else {
                Member::where('id', $id)->update(['status' => 1]);
            }
            return redirect()->back()->with('info', 'Learner status has been updated!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong when updating status, Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $delete = Member::find($id);
            $delete->delete();
            return redirect()->back()->with('info', 'Member has been deleted!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during deletion, Please try again.');
        }
    }
}
