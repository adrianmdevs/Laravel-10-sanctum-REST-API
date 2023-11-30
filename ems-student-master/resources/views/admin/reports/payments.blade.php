@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Payments Report</li>
@endsection
@section('title')
    Payments Report
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="border-bottom mb-3">
                    <form class="form-inline" method="post" action="{{url('/reports/generate/payments')}}">
                        @csrf
                        @method('GET')
                        <div class="form-group">
                            <label  for="form-username" class="mb-2 mr-sm-2 ">Course Units</label>
                            <select name="unit_id"  class="form-control mb-2 mr-sm-2  " style="width:200px;">
                                <option value="all">All</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id ?? ''}}">{{$unit->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="form-username" class="sr-only">Start Date </label>
                            <input type="text" name="start_date" placeholder="Start Date"
                                   id="datepicker-autoclose" class="form-control mb-2 mr-sm-2" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="form-username" class="sr-only">End Date </label>
                            <input type="text" name="end_date" placeholder="End Date"
                                   id="datepicker-autoclose1" class="form-control mb-2 mr-sm-2" required="" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Generate Report</button>
                    </form>
                </div>
                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead class="bg-primary text-center text-white">
                        <tr>
                            <th scope="col">S/No.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Mpesa Ref No.</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Learner Name</th>
                            <th scope="col">Course Unit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $i=>$payment)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{date('d-m-Y',strtotime($payment->created_at)) ?? ''}}</td>
                                <td>{{$payment->mpesa_ref_no ?? ''}}</td>
                                <td>Kshs. @convert($payment->amount)</td>
                                <td>{{$payment->member->fname ?? ''}}</td>
                                <td>{{$payment->unit->name ?? ''}}</td>
                            </tr>
                        @empty
                            <p>No data</p>
                        @endforelse


                        </tbody>
                    </table>
                </div><!--end reponsive table-->

            </div>
        </div>
    </div>
@endsection