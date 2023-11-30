@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/units')}}">Units</a></li>
    <li class="breadcrumb-item active">Unit Learners</li>
@endsection
@section('title')
    {{$unit->name ?? ''}} | Learners List
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
                                            class="nav-link">E-Books</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/exams')}}" aria-expanded="true"
                                            class="nav-link">Exams</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/members')}}"
                                            aria-expanded="true"
                                            class="nav-link active">Learners</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="datatable">
                                <thead class="bg-primary text-center text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Learner Name</th>
                                    <th scope="col">IHRM No.</th>
                                    <th scope="col">Date Enrolled</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $i=>$member)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$member->member->fname ?? ''}}</td>
                                        <td>{{$member->member->ihrm_no ?? ''}}</td>
                                        <td>{{date('d-m-Y',strtotime($member->created_at)) ?? ''}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div><!--end reponsive table-->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection