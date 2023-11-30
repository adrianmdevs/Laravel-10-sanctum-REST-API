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
                        <a href="{{url('/admin/courses/view/'.$course->id)}}"  aria-expanded="false"
                                            class="nav-link  ">Course info</a></li>
                    <li class="nav-item"><a href="{{url('/admin/courses/view/'.$course->id.'/units')}}" aria-expanded="true"
                                            class="nav-link active">Units</a></li>
                    {{--<li class="nav-item"><a href="" aria-expanded="true"--}}
                                            {{--class="nav-link">Learners</a></li>--}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="datatable">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Unit Name</th>
                                    <th scope="col">Unit Code</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($units as $i=>$unit)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$unit->name ?? ''}}</td>
                                        <td>{{$unit->unit_code ?? ''}}</td>
                                        <td>
                                            @if($unit->status==1)
                                                <span class="badge badge-pill badge-success">ACTIVE</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <p>No data</p>
                                @endforelse

                                </tbody>
                            </table>
                        </div><!--end reponsive table-->

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection