@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/member/result-slip')}}">Manage Result slips</a></li>
    <li class="breadcrumb-item active">{{$course->name}} Result Slip</li>
@endsection
@section('title')
    {{$course->name}} Result Slip
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Unit </th>
                            <th scope="col">Score in %</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(json_decode(json_encode($units)) as $i=>$unit)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$unit->unit ?? ''}}</td>
                                <td>{{$unit->score ?? ''}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!--end reponsive table-->
            </div>
        </div>
    </div>
@endsection

