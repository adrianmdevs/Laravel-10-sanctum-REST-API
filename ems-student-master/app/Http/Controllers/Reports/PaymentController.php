<?php

namespace App\Http\Controllers\Reports;

use App\Enrollment;
use App\Payment;
use App\Unit;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        $units = Unit::where('status', 1)->latest()->get();
        return view('admin.reports.payments')->with(compact('units', 'payments'));
    }

    public function approved_payments()
    {
        $payments = Payment::where('status', 1)->latest()->get();
        //dd($payments);
        return view('admin.reports.approved-payments')->with(compact('payments'));
    }

    public function pending_approvals()
    {
        $payments = Payment::where('status', 0)->latest()->get();
        return view('admin.reports.pending-approvals')->with(compact('payments'));
    }

    public function approve($id)
    {
        try {
            Payment::where('id', $id)->update(['status' => 1]);
            return redirect()->back()->with('info', 'Payment has been approved!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong when approving payment, Please try again.');
        }
    }

    public function print_payments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'unit_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $start = $request->start_date;
        $end = date("Y-m-d", strtotime($request->end_date . "+1 day"));
        if ($request->unit_id == 'all') {
            $course = "All";
            $payments = Payment::whereBetween('created_at', [$start, $end])->latest()->get();
        } else {
            $payments = Payment::whereBetween('created_at', [$start, $end])->where('unit_id', $request->unit_id)->latest()->get();
            $course = Unit::find($request->unit_id)->name;
            //dd($payments);
        }
        $hostname = $_SERVER['HTTP_HOST'];
        $pdf = PDF::loadView('admin.reports.payments-pdf',
            [
                'payments' => $payments,
                'start' => $start,
                'end' => $request->end_date,
                'hostname' => $hostname,
                'course' => $course
            ]
        )
            ->setPaper('a4', 'landscape');
        return $pdf->download("Payments_report_{$start}_{$request->end_date}.pdf");
    }
}
