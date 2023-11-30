@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/units')}}">Units</a></li>
    <li class="breadcrumb-item active">Exams</li>
@endsection
@section('title')
    {{$unit->name ?? ''}} | Exam Questions
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
                                            class="nav-link active">Exams</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/members')}}"
                                            aria-expanded="true"
                                            class="nav-link">Learners</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        @foreach($exams as $i=> $exam)
                        <ul class="list-unstyled">
                            <li class="media border-bottom border-info">
                                <img src="{{ Avatar::create($i+1)->toBase64() }}"  class="mr-3" style="width:54px;height:54px;"/>
                                <div class="media-body mb-2">
                                    <h5 class="mt-0 mb-1"><strong>Question:</strong> <em> {!! $exam->question !!}</em></h5>
                                    <!-- answers -->
                                    <div class="row">
                                        <div class="col-sm-8 offset-md-2">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                           Answer A: {!! $exam->option1 !!}
                                            @if($exam->answer==1)
                                            <span class="badge badge-success badge-pill p-1">Correct Answer <i class="fa fa-fw fa-check"></i></span>
                                                @endif
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Answer B: {!! $exam->option2 !!}
                                            @if($exam->answer==2)
                                                <span class="badge badge-success badge-pill p-1">Correct Answer <i class="fa fa-fw fa-check"></i></span>
                                            @endif
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Answer C: {!! $exam->option3 !!}
                                            @if($exam->answer==3)
                                                <span class="badge badge-success badge-pill p-1">Correct Answer <i class="fa fa-fw fa-check"></i></span>
                                            @endif
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Answer D: {!! $exam->option4 !!}
                                            @if($exam->answer==4)
                                                <span class="badge badge-success badge-pill p-1">Correct Answer <i class="fa fa-fw fa-check"></i></span>
                                            @endif
                                        </li>
                                    </ul>
                                    </div>
                                    </div>
                                    <!-- end answers-->
                                </div>
                            </li>

                        </ul>
                            @endforeach
                        <div class="pagination justify-content-center clearfix">
                                <span>{{ $exams->links() }}</span>
                        </div>
                        <!-- end tab-content-->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection