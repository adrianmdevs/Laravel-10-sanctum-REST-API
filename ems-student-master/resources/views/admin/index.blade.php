@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('title')
    Dashboard
@endsection
@section('content')

    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$member->fname}}</h4>
                    <div class="row">
                        <div class="col-sm-3">
                            @if(Auth::user()->avatar=='' || Auth::user()->avatar=='user.jpg' )
                                <img src="{{Avatar::create(Auth::user()->member->fname)->toBase64() }}" alt="user" class="rounded" />
                            @else
                                <img src="{{asset('/assets/images/users/'.Auth::user()->avatar)}}" alt="user" class="rounded" style="width:150px; height:150px;">
                            @endif
                        </div>
                        <!-- end first row-->
                        <div class="col-sm-4">
                            <p style="font-size: 1.1em;"><strong class="text-lg-left">IHRM No. : </strong> <span class="ml-3">{{$member->ihrm_no}}</span></p>
                            <p style="font-size: 1.1em;"><strong class="text-lg-left">Account Status : </strong> @if($member->status==1)
                                    <span class="badge badge-pill badge-success">ACTIVE</span>
                                @else
                                    <span class="badge badge-pill badge-danger">INACTIVE</span>
                                @endif</p>
                            <p style="font-size: 1.1em;"><strong class="text-lg-left">Joined On : </strong> <span class="ml-3">{{date('d-M-Y',strtotime($member->created_at)) ?? ''}}</span></p>
                        </div>
                        <!-- end third row-->
                        <div class="col-sm-5">
                            <p style="font-size: 1.1em;"><strong class="text-lg-left">Total Course Units : </strong> <span class="ml-3">{{$enrollments}}</span></p>
                            <p style="font-size: 1.1em;"><strong class="text-lg-left">Last Login : </strong> <span class="ml-3">{{date('d-M-Y H:i:a',strtotime(Auth::user()->last_login)) ?? ''}}</span></p>
                        </div>
                        <!-- end third row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <!-- fetch member -->
                <div class="card-header bg-info text-white mb-3">
                    LEARNER'S PROFILE
                </div>
                <div class="clearfix"></div>
                <form role="form" action="{{url('/dashboard/update')}}" method="post">
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
                        <button type="submit" class="btn btn-info">Update Info
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
