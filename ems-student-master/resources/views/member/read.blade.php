@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/dashboard/units')}}">Course Units</a></li>
    <li class="breadcrumb-item"><a href="{{url('/dashboard/books/'.$book->unit_id)}}">Books</a></li>
    <li class="breadcrumb-item active">{{$book->title}}</li>
@endsection
@section('title')
    {{$book->title}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <!-- read book -->
<!-- start book reading-->
                <div class="embed-responsive embed-responsive-1by1">
                    <iframe class="embed-responsive-item" src="http://achrp-admin.io/book/read/{{$book->id}}"></iframe>
                </div>
<!-- end book reading-->
            </div>
        </div>
    </div>

@endsection

