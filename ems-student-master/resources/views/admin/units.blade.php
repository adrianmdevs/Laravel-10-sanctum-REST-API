@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Units</li>
@endsection
@section('title')
    Course Units
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
                            <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Create Unit</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ url('/admin/units') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label  for="form-username">Unit name <span class="text-danger">*</span></label>
                                        <input type="text" name="name"  placeholder=".. Unit name" required="" class=" form-control">
                                    </div>
                                    <div class="form-group">
                                        <label  for="form-username">Unit Code <span class="text-danger">*</span></label>
                                        <input type="text" name="unit_code"  placeholder=".. Unit Code" required="" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username">Unit Cost <span class="text-danger">*</span></label>
                                        <input type="number" name="price" placeholder="Enter Unit Cost"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label  for="form-username">Course <span class="text-danger">*</span></label>
                                        <select name="course_id"  class="form-control select2" >
                                            <option value="">--Choose Course --</option>
                                            @foreach($courses as $course)
                                            <option value="{{$course->id ?? ''}}">{{$course->name ?? ''}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="form-username">Description (Optional)</label>
                                        <textarea name="description" placeholder="Unit details" class="form-control" ></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                                        </button>
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="fa fa-close"></i>
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
                            data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i>Add Unit
                    </button>
                </div>
                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Unit Code</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Course</th>
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
                                <td>{{$unit->price ?? ''}}</td>
                                <td>{{$unit->course->name ?? ''}}</td>
                                <td>
                                    @if($unit->status==1)
                                        <span class="badge badge-pill badge-success">ACTIVE</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">INACTIVE</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/admin/units/view/'.$unit->id)}}" class="btn btn-success btn-sm">View</a>
                                    <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal"
                                       data-target="#status-modal-{{ $unit->id }}"><i class="fa fa-fw fa-refresh"></i>Toggle Status</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                       data-target="#delete-modal-{{ $unit->id }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                                <!-- ====================Toggle status Modal===========================  -->
                                <div id="status-modal-{{ $unit->id }}" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>Are you sure you want to change the status?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('/admin/units/toggle-status/'.$unit->id) }}"
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
                                <div id="delete-modal-{{ $unit->id }}" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete this unit?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('/admin/units/delete/'.$unit->id) }}"
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