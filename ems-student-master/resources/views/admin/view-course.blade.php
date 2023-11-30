@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/courses')}}">Courses</a></li>
    <li class="breadcrumb-item active">Course</li>
@endsection
@section('title')
    {{$course->name ?? ''}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg border-bottom pb-1 ">
                    <li class="nav-item">
                        <a href="{{url('/admin/courses/view/'.$course->id)}}" aria-expanded="false"
                           class="nav-link active ">Course info</a></li>
                    <li class="nav-item"><a href="{{url('/admin/courses/view/'.$course->id.'/units')}}"
                                            aria-expanded="true"
                                            class="nav-link">Units</a></li>
                    {{--<li class="nav-item"><a href="" aria-expanded="true"--}}
                                            {{--class="nav-link">Learners</a></li>--}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <form role="form" action="{{url('/admin/courses/view/'.$course->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="form-username">Course name</label>
                                <input type="text" name="name" value="{{$course->name ?? ''}}" class=" form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-username">Course Code</label>
                                <input type="text" name="course_code" value="{{$course->course_code ?? ''}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-username">Description </label>
                                <textarea name="description"
                                          class="form-control">{{$course->description ?? ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-lg">Update Details
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection