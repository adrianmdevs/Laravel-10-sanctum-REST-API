<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function index($id){
        $member = Member::find($id);
        $enrollments = $member->enrollments()->get();
        //dd($enrollments);
        return view('admin.enroll.certificates')->with(compact('member', 'enrollments'));
    }
}
