@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Exams</li>
@endsection
@section('title')
    Exam Questions
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="text-center mb-3">
                   <h3 class="text-success">Create Question</h3>
                </div>
                <div class="clearfix"></div>
                <!-- create Questions -->

                <form role="form" action="{{ url('/admin/exams') }}" method="post">
                    @csrf
                    <div class="form-group">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label  for="form-username">Courses <span class="text-danger">*</span></label>
                        <select   id="course" class="form-control select2" >
                            <option value="">--Choose Course --</option>
                            @foreach($courses as $course)
                                <option value="{{$course->id ?? ''}}">{{$course->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label  for="form-username">Course Unit <span class="text-danger">*</span></label>
                        <select name="unit_id"  id="unit" class="form-control select2" >

                        </select>
                    </div>
                    <div class="form-group">
                        <label  for="form-username">Question <span class="text-danger">*</span></label>
                        <textarea name="question" placeholder="Question details" class="form-control" ></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="form-group">
                                <label  for="form-username">Answer A <span class="text-danger">*</span></label>
                                <input type="text" name="option1"  placeholder="Option 1 Answer" required="" class=" form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check mt-lg-4">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios1" value="1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Correct Answer?
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- end option 1-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  for="form-username">Answer B <span class="text-danger">*</span></label>
                                <input type="text" name="option2"  placeholder="Option 2 Answer" required="" class=" form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check mt-lg-4">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios1" value="2">
                                <label class="form-check-label" for="exampleRadios1">
                                    Correct Answer?
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- end option 2-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  for="form-username">Answer C <span class="text-danger">*</span></label>
                                <input type="text" name="option3"  placeholder="Option 3 Answer" required="" class=" form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check mt-lg-4">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios1" value="3">
                                <label class="form-check-label" for="exampleRadios1">
                                    Correct Answer?
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- end option 3-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  for="form-username">Answer D <span class="text-danger">*</span></label>
                                <input type="text" name="option4"  placeholder="Option 4 Answer" required="" class=" form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check mt-lg-4">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios1" value="4">
                                <label class="form-check-label" for="exampleRadios1">
                                    Correct Answer?
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- end option 1-->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#course').on('change', function (event) {
                var courseId = $(this).val();
                if (courseId) {
                    $.ajax({
                        url: '/admin/exams/course/units/' + courseId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                                html += '<option value=\''+ data[i].id +'\'>' +data[i].name +'</option>';
                            }
                            $("#unit").html(html);


                        },

                    });

                }

                else {
                    var html = '';
                    $("#unit").html(html);
                }
                event.preventDefault();
            });

        });

    </script>
@endsection
