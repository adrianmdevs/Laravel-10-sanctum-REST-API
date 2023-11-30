@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/dashboard/units')}}">Course Units</a></li>
    <li class="breadcrumb-item active">Exam Results</li>
@endsection
@section('title')
    Exam Results
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box border-bottom border-light mb-5">
                @if($scores->isEmpty())
                    <h4 class="card-title ">Total
                        Score: 0%</h4>
                    <p>Number of Questions: <strong>{{$scores->count()}}</strong>
                    </p>
                    <hr>
                    <p class="card-text">Find your certificates and exam results <a
                                href="{{url('/dashboard/certificates')}}" class="text-primary">
                            Here</a></p>
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
                    <p class="card-text">Find your certificates and exam results <a
                                href="{{url('/dashboard/certificates')}}" class="text-primary">
                            Here</a></p>
                @endif

            </div>
        </div>
    </div>
@endsection
