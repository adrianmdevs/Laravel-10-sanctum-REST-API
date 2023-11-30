@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/learners')}}">Learners</a></li>
    <li class="breadcrumb-item active">Enrolled Units</li>
@endsection
@section('title')
    {{$member->fname ?? 'Learner'}} | Enrolled Units
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg border-bottom border-primary pb-1 ">
                    <li class="nav-item">
                        <a href="{{url('/admin/learners/view/'.$member->id)}}" aria-expanded="false"
                           class="nav-link">Learner details</a></li>
                    <li class="nav-item">
                        <a href="{{url('/admin/learners/enroll/'.$member->id)}}" aria-expanded="false"
                           class="nav-link ">Enroll</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/course-units/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link active">Course Units</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/payments/'.$member->id)}}" aria-expanded="true"
                                            class="nav-link">Payments</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/certificates/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link">Certificates</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unit Code</th>
                                    <th>Unit Name</th>
                                    <th>Date Enrolled</th>
                                    <th>Transcript</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($enrollments as $i=>$enrollment)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$enrollment->unit->unit_code ?? ''}}</td>
                                        <td>{{$enrollment->unit->name ?? ''}}</td>
                                        <td>{{date('d-m-Y',strtotime($enrollment->created_at)) ?? ''}}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-file-pdf-o fa-fw"></i>Generate</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                               data-target="#delete-modal-{{ $enrollment->id }}"><i
                                                        class="fa fa-close"></i></a>
                                        </td>
                                        <!-- ====================Delete Modal===========================  -->
                                        <div id="delete-modal-{{ $enrollment->id }}" class="modal fade" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                             style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h5>Are you sure you want to de-register
                                                            <u>{{$member->fname}}</u> from this unit?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ url('/admin/learners/unit/delete/'.$enrollment->id) }}"
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

