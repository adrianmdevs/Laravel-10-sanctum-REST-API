@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Learners Report</li>
@endsection
@section('title')
    Learners Report
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
                    <form class="form-inline" method="post" action="{{url('/reports/generate/learners')}}">
                        @csrf
                        @method('GET')
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
                            <th scope="col">#</th>
                            <th scope="col">Learner Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">National ID</th>
                            <th scope="col">IHRM No.</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Joined</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $i=>$member)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$member->fname ?? ''}}</td>
                                <td>{{$member->email ?? ''}}</td>
                                <td>{{$member->phone ?? ''}}</td>
                                <td>{{$member->nid ?? ''}}</td>
                                <td>{{$member->ihrm_no ?? ''}}</td>
                                <td>
                                    @if($member->status==1)
                                        <span class="badge badge-pill badge-success">ACTIVE</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">INACTIVE</span>
                                    @endif
                                </td>
                                <td>{{date('Y-m-d',strtotime($member->created_at)) ?? ''}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!--end reponsive table-->

            </div>
        </div>
    </div>
@endsection