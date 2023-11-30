@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/learners')}}">Learners</a></li>
    <li class="breadcrumb-item active">Learner details</li>
@endsection
@section('title')
    {{$member->fname ?? 'Learner'}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg border-bottom pb-1 ">
                    <li class="nav-item">
                        <a href="{{url('/admin/learners/view/'.$member->id)}}" aria-expanded="false"
                           class="nav-link active ">Learner details</a></li>
                    <li class="nav-item">
                        <a href="{{url('/admin/learners/enroll/'.$member->id)}}" aria-expanded="false"
                           class="nav-link">Enroll</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/course-units/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link">Course Units</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/payments/'.$member->id)}}" aria-expanded="true"
                                            class="nav-link">Payments</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/certificates/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link">Certificates</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <form role="form" action="{{url('/admin/learners/view/'.$member->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label for="form-username">Full Name</label>
                                        <input type="text" name="fname" value="{{$member->fname ?? ''}}"
                                               class=" form-control">
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">National ID </label>
                                        <input type="text" name="nid" value="{{$member->nid ?? ''}}"
                                               class="form-control">
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Date of Birth </label>
                                        <input type="text" name="dob" value="{{$member->dob ?? ''}}"
                                               id="datepicker-autoclose" class="form-control" autocomplete="off">
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Phone No.</label>
                                        <input type="text" name="phone" value="{{$member->phone ?? ''}}"
                                               class="form-control">
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Email Address</label>
                                        <input type="email" name="email" value="{{$member->email ?? ''}}"
                                               class="form-control">
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">IHRM No.</label>
                                        <input type="text" name="ihrm_no" value="{{$member->ihrm_no ?? ''}}"
                                               class="form-control">
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-lg">Update Info
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection