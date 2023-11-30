@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection
@section('title')
    My Profile
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8  offset-sm-2">
            <div class="card-box">
                <h4 class="header-title m-t-0 border-bottom p-2">View Profile</h4>
                <form role="form" action="{{ url('/member/profile') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group text-center">
                        @if(Auth::user()->avatar=='')
                            <img src="{{asset('/assets/images/users/user.jpg')}}" alt="user" class="img-rounded" style="height: 150px; width: 200px;">
                        @else
                            <img src="{{asset('/assets/images/users/'.Auth::user()->avatar)}}" alt="user" class="img-rounded" style="height: 150px; width: 200px;">
                        @endif
                    </div>
                    @csrf
                    <div class="form-group">
                        <label  for="form-username">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-username form-control">
                    </div>
                    <div class="form-group">
                        <label  for="form-username">User Photo</label>
                        <input type="file" name="avatar" value="{{ $user->avatar }}" class="form-username form-control" >
                    </div>

                    <div class="form-group">
                        <label  for="form-username">Email  Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-username form-control" >
                    </div>
                    <div class="form-group text-center m-b-0">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Submit
                        </button>
                    </div>
                </form>
            </div><!-- end card-box -->
        </div><!-- end col -->
    </div>
@endsection