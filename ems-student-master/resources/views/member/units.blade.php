@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"> Units</li>
@endsection
@section('title')
    My Units
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Code</th>
                            <th>Unit Name</th>
                            <th>Date Enrolled</th>
                            {{--<th>Transcript</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($enrollments as $i=>$enrollment)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$enrollment->unit->unit_code ?? ''}}</td>
                                <td><span data-toggle="tooltip" data-placement="top"
                                          title="{{$enrollment->unit->description ?? ''}}">{{$enrollment->unit->name ?? ''}}</span>
                                </td>
                                <td>{{date('d-m-Y',strtotime($enrollment->created_at)) ?? ''}}</td>
                                {{--<td>--}}
                                {{--<a href="#" class="btn btn-primary btn-sm"><i--}}
                                {{--class="fa fa-file-pdf-o fa-fw"></i>Generate</a>--}}
                                {{--</td>--}}
                                <td>
                                    <a class="btn btn-info btn-sm mr-2 mb-2"
                                       href="{{url('/dashboard/books/'.$enrollment->unit->id)}}">Course
                                        materials </a>
                                    <a class="btn btn-info btn-sm mb-2"
                                       href="{{url('/dashboard/exams/'.$enrollment->unit->id)}}">Exams</a>
                                    {{-- <div class="dropdown">
                                        <a class="text-success" href="#" role="button" id="dropdownMenuLink"
                                           data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h fa-3x"></i>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item"
                                               href="{{url('/dashboard/books/'.$enrollment->unit->id)}}">Course
                                                materials <i
                                                        class="fa fa-book"></i></a>
                                            <a class="dropdown-item" href="{{url('/dashboard/exams/'.$enrollment->unit->id)}}">Take Exam <i
                                                        class="fa fa-pencil"></i></a>
                                        </div>
                                    </div> --}}
                                </td>
                                {{--<td>--}}
                                {{--<a href="#" class="btn btn-danger btn-sm" data-toggle="modal"--}}
                                {{--data-target="#delete-modal-{{ $enrollment->id }}"><i--}}
                                {{--class="fa fa-close"></i></a>--}}
                                {{--</td>--}}
                                {{--<!-- ====================Delete Modal===========================  -->--}}
                                {{--<div id="delete-modal-{{ $enrollment->id }}" class="modal fade" tabindex="-1"--}}
                                {{--role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"--}}
                                {{--style="display: none;">--}}
                                {{--<div class="modal-dialog" role="document">--}}
                                {{--<div class="modal-content">--}}
                                {{--<div class="modal-body">--}}
                                {{--<h5>Are you sure you want to de-register--}}
                                {{--<u>{{$member->fname}}</u> from this unit?</h5>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                {{--<a href="{{ url('/admin/learners/unit/delete/'.$enrollment->id) }}"--}}
                                {{--class="btn btn-success float-left">Okay</a>--}}
                                {{--<button type="button" class="btn btn-danger"--}}
                                {{--data-dismiss="modal">Cancel--}}
                                {{--</button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div><!-- /.modal-dialog -->--}}
                                {{--</div><!-- /.modal -->--}}
                                {{--<!-- ====================End Delete Modal===========================  -->--}}
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

