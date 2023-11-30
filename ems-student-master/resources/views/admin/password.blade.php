@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Change Password</li>
@endsection
@section('title')
    Change Password
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8  offset-sm-2">
            <div class="card-box">
                <h4 class="header-title m-t-0 border-bottom p-2">Update Password</h4>
                <form role="form" action="{{ url('/member/password') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label  for="form-username">Current Password</label>
                        <input type="password" name="cpassword" placeholder="Enter current Password" class="form-username form-control" required parsley-type="password">
                    </div>
                    <div class="form-group">
                        <label  for="form-username">New Password</label>
                        <input type="password" name="password" placeholder="Enter New Password" class="form-username form-control" required parsley-type="password" id="pass1">
                    </div>
                    <div class="form-group">
                        <label  for="form-username">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm New Password" class="form-username form-control" required parsley-type="password" data-parsley-equalto="#pass1">
                    </div>
                    <div class="form-group text-center m-b-0">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Update Password
                        </button>
                    </div>
                </form>
            </div><!-- end card-box -->
        </div><!-- end col -->
    </div>
@endsection