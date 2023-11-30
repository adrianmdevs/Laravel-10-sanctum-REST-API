@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/dashboard/units')}}">Course Units</a></li>
    <li class="breadcrumb-item active">Books</li>
@endsection
@section('title')
    Learning Materials
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
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
                                    <a href="{{url('member/book/'.$document->id.'/read')}}"
                                       class="btn btn-success btn-sm">Read</a>
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
@endsection
