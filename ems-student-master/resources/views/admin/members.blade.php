@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Learners</li>
@endsection
@section('title')
    Learners
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <!-- start modal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header border-bottom"><h4 class="modal-title" id="myModalLabel"> Learner
                                    details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ url('/admin/learners') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form-username">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" name="fname" placeholder="Learner's Full name"
                                                       required="" class=" form-control">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form-username">National ID <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="nid" placeholder="National ID Number"
                                                       required="" class="form-control">
                                            </div>
                                        </div><!--end col-->
                                    </div><!-- end row-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form-username">Date of Birth <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="dob" placeholder="Date of Birth"
                                                       id="datepicker-autoclose" required="" class="form-control" autocomplete="off">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form-username">Phone No. <span class="text-danger">*</span></label>
                                                <input type="text" name="phone" placeholder="Enter Phone Number"
                                                       required="" class="form-control">
                                            </div>
                                        </div><!--end col-->
                                    </div><!-- end row-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form-username">Email Address <span
                                                            class="text-danger">*</span></label>
                                                <input type="email" name="email" placeholder="Enter Email" required=""
                                                       class="form-control">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form-username">IHRM No.</label>
                                                <input type="text" name="ihrm_no" placeholder="IHRM Number"
                                                       class="form-control">
                                            </div>
                                        </div><!--end col-->
                                    </div><!-- end row-->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save details
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
                            data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i>Add Learner
                    </button>
                </div>
                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Learner Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Joined On</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($members as $i=>$member)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$member->fname ?? ''}}</td>
                                <td>{{$member->email ?? ''}}</td>
                                <td>{{$member->phone ?? ''}}</td>
                                <td>
                                    @if($member->status==1)
                                        <span class="badge badge-pill badge-success">ACTIVE</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">INACTIVE</span>
                                    @endif
                                </td>
                                <td>{{date('Y-m-d',strtotime($member->created_at)) ?? ''}}</td>
                                <td>
                                    <a href="{{url('/admin/learners/view/'.$member->id)}}" class="btn btn-success btn-sm">View</a>
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                       data-target="#status-modal-{{ $member->id }}"><i class="fa fa-fw fa-refresh"></i>Toggle
                                        Status</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                       data-target="#delete-modal-{{ $member->id }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                                <!-- ====================Toggle status Modal===========================  -->
                                <div id="status-modal-{{ $member->id }}" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>Are you sure you want to change the status?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('/admin/learners/toggle-status/'.$member->id) }}"
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
                                <div id="delete-modal-{{ $member->id }}" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete this learner?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('/admin/learners/delete/'.$member->id) }}"
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