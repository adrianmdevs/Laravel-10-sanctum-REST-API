<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class PaymentController extends Controller
{
    public function index($id)
    {
        $member = Member::find($id);
        $payments = $member->payments()->get();
        //dd($payments);
        return view('admin.enroll.payments')->with(compact('member', 'payments'));
    }

    public function receipt($id)
    {
        $payment = Payment::find($id);
        //dd($payment);
        $hostname = $_SERVER['HTTP_HOST'];
        $pdf = PDF::loadView('admin.reports.receipt',
            [
                'payment' => $payment,
                'hostname' => $hostname
            ]
        )
            ->setPaper('a4', 'portrait');
        return $pdf->download("{$payment->created_at}_Receipt.pdf");
    }

    public function delete($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->back()->with('info', 'Payment record has been deleted!');
    }

}
