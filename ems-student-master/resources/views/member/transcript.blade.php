@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transcripts</li>
@endsection
@section('title')
    My Transcripts
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Code</th>
                            <th>Unit Name</th>
                            <th>Date Enrolled</th>
                            <th>Results</th>
                            <th>Certificate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($enrollments as $i=>$enrollment)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$enrollment->unit->unit_code ?? ''}}</td>
                                <td>{{$enrollment->unit->name ?? ''}}</td>
                                <td>{{date('d-m-Y',strtotime($enrollment->created_at)) ?? ''}}</td>
                                <td>
                                    <a href="{{url('/exams/result/'.$enrollment->unit_id)}}"
                                       class="btn btn-info btn-sm"><i
                                                class="fa fa-eye-slash fa-fw"></i>View Results</a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                class="fa fa-cloud-download fa-fw"></i>Download</a>
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

