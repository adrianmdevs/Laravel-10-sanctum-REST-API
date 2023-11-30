@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Courses</li>
@endsection
@section('title')
    Courses
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <!-- start modal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Create Course</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ url('/admin/courses') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="form-username">Course name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder=".. Course name" required=""
                                               class=" form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username">Course Code <span class="text-danger">*</span></label>
                                        <input type="text" name="course_code" placeholder=".. Course Code" required=""
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label  for="form-username">Description (Optional)</label>
                                        <textarea name="description" placeholder="More Course details" class="form-control" ></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                                        </button>
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                                            <i class="fa fa-close"></i>
                                        </button>

                                    </div>
                                </form>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div>
                <!-- end modal -->
                <div class="float-right mb-3">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal"
                            data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i>Add Course
                    </button>
                </div>
                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                <table class="table table-bordered table-sm" id="datatable">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($courses as $i=>$course)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$course->name ?? ''}}</td>
                            <td>{{$course->course_code ?? ''}}</td>
                            <td>
                                @if($course->status==1)
                                    <span class="badge badge-pill badge-success">ACTIVE</span>
                                @else
                                    <span class="badge badge-pill badge-danger">INACTIVE</span>
                                    @endif
                            </td>
                            <td>
                                <a href="{{url('/admin/courses/view/'.$course->id)}}" class="btn btn-success btn-sm">View</a>
                                <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal"
                                   data-target="#status-modal-{{ $course->id }}"><i class="fa fa-fw fa-refresh"></i>Toggle Status</a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                   data-target="#delete-modal-{{ $course->id }}"><i class="fa fa-trash-o"></i></a>
                            </td>
                            <!-- ====================Toggle status Modal===========================  -->
                            <div id="status-modal-{{ $course->id }}" class="modal fade" tabindex="-1"
                                 role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                 style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5>Are you sure you want to change the status?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ url('/admin/courses/toggle-status/'.$course->id) }}"
                                               class="btn btn-success float-left">Okay</a>
                                            <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <!-- ====================End Toggle status Modal===========================  -->

                            <!-- ====================Delete Modal===========================  -->
                            <div id="delete-modal-{{ $course->id }}" class="modal fade" tabindex="-1"
                                 role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                 style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5>Are you sure you want to delete this course?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ url('/admin/courses/delete/'.$course->id) }}"
                                               class="btn btn-success float-left">Okay</a>
                                            <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <!-- ====================End Delete Modal===========================  -->
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
@endsection