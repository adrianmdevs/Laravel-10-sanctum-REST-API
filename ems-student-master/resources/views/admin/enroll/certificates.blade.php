@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/learners')}}">Learners</a></li>
    <li class="breadcrumb-item active">Certificates</li>
@endsection
@section('title')
    {{$member->fname ?? 'Learner'}} | Certificates
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg border-bottom border-primary pb-1 ">
                    <li class="nav-item">
                        <a href="{{url('/admin/learners/view/'.$member->id)}}" aria-expanded="false"
                           class="nav-link">Learner details</a></li>
                    <li class="nav-item">
                        <a href="{{url('/admin/learners/enroll/'.$member->id)}}" aria-expanded="false"
                           class="nav-link ">Enroll</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/course-units/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link">Course Units</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/payments/'.$member->id)}}" aria-expanded="true"
                                            class="nav-link">Payments</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/certificates/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link active">Certificates</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">

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
                                            <a href="#" class="btn btn-info btn-sm"><i
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
        </div>
    </div>
@endsection

