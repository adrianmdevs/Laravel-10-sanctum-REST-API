@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/units')}}">Units</a></li>
    <li class="breadcrumb-item active">Books</li>
@endsection
@section('title')
    Learning Materials
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg border-bottom pb-1 ">
                    <li class="nav-item">
                        <a href="{{url('/admin/units/view/'.$unit->id)}}" aria-expanded="false"
                           class="nav-link">Unit info</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/books')}}"
                                            aria-expanded="true"
                                            class="nav-link active ">E-Books</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/exams')}}" aria-expanded="true"
                                            class="nav-link">Exams</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/members')}}"
                                            aria-expanded="true"
                                            class="nav-link">Learners</a></li>
                </ul>
                <!-- start modal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Add Book</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <!-- start uploading form-->
                                <form id="demo-form" method="post"
                                      action="{{url('admin/units/view/'.$unit->id.'/books')}}"
                                      enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="unit_id" value="{{$unit->id}}">

                                    <div class="form-group">
                                        <label for="form-username">Title of the book <span class="text-danger">*</span></label>
                                        <input type="text" name="title" placeholder="..Enter Title"
                                               class=" form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username">Description (Optional)</label>
                                        <textarea name="description" class=" form-control">
        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-username"> Document <span class="text-danger">*</span></label>
                                        <input type="file" name="document" class=" form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                                        </button>
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                                            <i class="fa fa-close"></i>
                                        </button>

                                    </div>
                                </form>
                                <!-- end uploading form-->

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div>
                <!-- end modal -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="float-right mb-3">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal"
                                    data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i>Add Book
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <!-- fetch courses -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="datatable">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($documents as $i=>$document)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$document->title ?? ''}}</td>
                                        <td>{{$document->description ?? ''}}</td>
                                        <td>
                                            <a href="{{ url('uploads/books/'.$document->document)}}" target="_blank"
                                               class="btn btn-success btn-sm">View</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                               data-target="#delete-modal-{{ $document->id }}"><i
                                                        class="fa fa-trash-o"></i></a>
                                        </td>
                                        <!-- ====================Delete Modal===========================  -->
                                        <div id="delete-modal-{{ $document->id }}" class="modal fade" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                             style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h5>Are you sure you want to delete this book?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ url('admin/units/document/'.$document->id.'/delete') }}"
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
        </div>
    </div>
@endsection