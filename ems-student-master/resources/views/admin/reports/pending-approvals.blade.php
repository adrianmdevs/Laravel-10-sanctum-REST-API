@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pending Approvals</li>
@endsection
@section('title')
    View Pending Approvals
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead class="bg-info text-center text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Mpesa Ref No.</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Learner Name</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $i=>$payment)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{date('d-m-Y',strtotime($payment->created_at)) ?? ''}}</td>
                                <td>{{$payment->mpesa_ref_no ?? ''}}</td>
                                <td>Kshs. @convert($payment->amount)</td>
                                <td>{{$payment->member->fname ?? ''}}</td>
                                <td>{{$payment->unit->name ?? ''}}</td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                       data-target="#approve-modal-{{ $payment->id }}"><i class="fa fa-check fa-fw"></i>Approve</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                       data-target="#delete-modal-{{ $payment->id }}"><i class="fa fa-close"></i></a>
                                </td>
                                <!-- ====================Approve Modal===========================  -->
                                <div id="approve-modal-{{ $payment->id }}" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>Are you sure you want to approve this payment?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('/reports/payment/approve/'.$payment->id) }}"
                                                   class="btn btn-success float-left">Okay</a>
                                                <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- ====================End Approve Modal===========================  -->

                                <!-- ====================Delete Modal===========================  -->
                                <div id="delete-modal-{{ $payment->id }}" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete this payment record?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url('/admin/learners/payment/delete/'.$payment->id) }}"
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