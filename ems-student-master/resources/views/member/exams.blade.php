@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/dashboard/units')}}">Course Units</a></li>
    <li class="breadcrumb-item active">Exams</li>
@endsection
@section('title')
    @if($answers->isEmpty())  Exam Questions @else Exam Scores @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box border-bottom border-light mb-5">
                @if($answers->isEmpty())
                    <form action="{{url('/exams/submit-answer')}}" method="post" class="ansform">
                        @csrf
                        @foreach($exams as $i=> $exam)
                            <ul class="list-unstyled">
                                <li class="media border-bottom border-info">
                                    <img src="{{ Avatar::create($i+1)->toBase64() }}" class="mr-3"
                                         style="width:54px;height:54px;"/>

                                    <div class="media-body mb-2">
                                        <h5 class="mt-0 mb-1"><strong>Question:</strong>
                                            <em> {!! $exam->question !!}</em></h5>
                                        <!-- answers -->
                                        <input type="hidden" name="question_id[]" value="{{$exam->id}}">
                                        <input type="hidden" name="member_id" value="{{Auth::user()->member->id}}">
                                        <div class="row">
                                            <div class="col-sm-8 offset-md-2">

                                                <ul class="list-group">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Answer A: {!! $exam->option1 !!}
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="answer{{$exam->id}}"
                                                                   id="exampleRadios1" value="1">
                                                            <label class="form-check-label" for="exampleRadios1">
                                                                Correct?
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Answer B: {!! $exam->option2 !!}
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="answer{{$exam->id}}"
                                                                   id="exampleRadios2" value="2">
                                                            <label class="form-check-label" for="exampleRadios2">
                                                                Correct?
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Answer C: {!! $exam->option3 !!}
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="answer{{$exam->id}}"
                                                                   id="exampleRadios3" value="3">
                                                            <label class="form-check-label" for="exampleRadios3">
                                                                Correct?
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Answer D: {!! $exam->option4 !!}
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="answer{{$exam->id}}"
                                                                   id="exampleRadios4" value="4">
                                                            <label class="form-check-label" for="exampleRadios4">
                                                                Correct?
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <!-- end answers-->
                                    </div>

                                </li>

                            </ul>

                        @endforeach

                        {{--<div class="pagination justify-content-center clearfix">--}}
                        {{--<span>{{ $exams->links() }}</span>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>

                        <div class="form-group text-center">
                            @if($exams->isEmpty())
                                <h1>No questions available</h1>
                            @else
                            <button type="submit" class="btn btn-primary rounded-0 btn-lg">Submit Answers</button>
                                @endif
                        </div>
                    </form>
                @else
                    <h4 class="card-title ">Total
                        Score: {{(int)((($scores->where('correct',1)->count())/($scores->count()))*100+.5)}}%</h4>
                    <p>Number of Questions: <strong>{{$scores->count()}}</strong> |
                        <button type="button" class="btn btn-info btn-sm">
                            Correct Answers: <span
                                    class="badge badge-light">{{$scores->where('correct',1)->count()}}</span>
                            <span class="sr-only"> </span>
                        </button>
                    </p>
                    <hr>
                    <p class="card-text">Find your certificates and exam results <a href="{{url('/dashboard/certificates')}}" class="text-primary">
                            Here</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
