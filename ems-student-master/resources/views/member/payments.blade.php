@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Payments</li>
@endsection
@section('title')
    My Payments
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Name</th>
                            <th>Amount Paid</th>
                            <th>Date Paid</th>
                            <th>Mpesa Code</th>
                            <th>Confirmed?</th>
                            <th>Print Receipt</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $i=>$payment)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$payment->unit->name ?? ''}}</td>
                                <td>Kshs. @convert($payment->amount)</td>
                                <td>{{date('d-m-Y',strtotime($payment->created_at)) ?? ''}}</td>
                                <td>{{$payment->mpesa_ref_no ?? ''}}</td>
                                <td>
                                    @if($payment->status==1)
                                        <span class="badge badge-pill badge-success">YES</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">NO</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->status==1)
                                        <a href="{{url('/dashboard/receipt/'.$payment->id)}}"
                                           class="btn btn-primary btn-sm" target="_blank"><i
                                                    class="fa fa-print fa-fw"></i>Print</a>
                                    @else
                                        <span class="badge badge-pill badge-danger">Not Available</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <p>No data</p>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

