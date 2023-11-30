@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Result Slip</li>
@endsection
@section('title')
    Manage Result Slip(s)
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
                            <th scope="col">Course</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $i=>$course)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$course->course ?? ''}}</td>
                                <td>{{$course->course_description ?? ''}}</td>
                                <td>
                                    <a href="{{url('dashboard/result-slip/'.$course->course_id.'/show')}}"
                                       class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View Slip</a>
                                    <a href="{{url('dashboard/result-slip/'.$course->course_id.'/download')}}"
                                       class="btn btn-success btn-sm"><i class="fa fa-cloud-download"></i> Download</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!--end reponsive table-->
            </div>
        </div>
    </div>
@endsection

