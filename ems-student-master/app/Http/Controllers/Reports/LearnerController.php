<?php

namespace App\Http\Controllers\Reports;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use PDF;

class LearnerController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.reports.learners')->with(compact('members'));
    }

    public function print_learners(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $start = $request->start_date;
        $end = date("Y-m-d", strtotime($request->end_date . "+1 day"));
        $members = Member::whereBetween('created_at', [$start, $end])->get();
        $hostname = $_SERVER['HTTP_HOST'];
        $pdf = PDF::loadView('admin.reports.learners-pdf',
            [
                'members' => $members,
                'start' => $start,
                'end' => $request->end_date,
                'hostname' => $hostname
            ]
        )
            ->setPaper('a4', 'landscape');
        return $pdf->download("Learners_report_{$start}_{$request->end_date}.pdf");
    }
}
