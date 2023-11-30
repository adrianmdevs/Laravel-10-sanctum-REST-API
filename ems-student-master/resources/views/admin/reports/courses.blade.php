@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Courses Report</li>
@endsection
@section('title')
    Enrollments Per Course Report
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="border-bottom mb-3">
                    <form class="form-vertical" method="post" action="{{url('/reports/generate/courses')}}">
                        @csrf
                        @method('GET')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                        <div class="form-group">
                            <label  for="form-username">Courses</label>
                            <select   id="course" class="custom-select select2">
                                <option value="">--Select Course --</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id ?? ''}}">{{$course->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                            </div>
                            <div class="col-sm-3">
                        <div class="form-group">
                            <label  for="form-username">Unit </label>
                            <select name="unit_id"  id="unit" class="form-control select2" required>
                            </select>
                        </div>
                            </div>
                            <div class="col-sm-2">
                        <div class="form-group">
                            <label for="form-username" >Start Date </label>
                            <input type="text" name="start_date" placeholder="Start Date"
                                   id="datepicker-autoclose" class="form-control" required="" autocomplete="off">
                        </div>
                            </div>
                            <div class="col-sm-2">
                        <div class="form-group">
                            <label for="form-username">End Date </label>
                            <input type="text" name="end_date" placeholder="End Date"
                                   id="datepicker-autoclose1" class="form-control" required="" autocomplete="off">
                        </div>
                            </div>
                            <div class="col-sm-2">
                        <button type="submit" class="btn btn-success mt-3">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
                <!-- fetch courses -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable">
                        <thead class="bg-primary text-center text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course</th>
                            <th scope="col">Course Unit</th>
                            <th scope="col">Learner Name</th>
                            <th scope="col">IHRM No.</th>
                            <th scope="col">Date Enrolled</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $i=>$member)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$member->unit->course->name ?? ''}}</td>
                                <td>{{$member->unit->name ?? ''}}</td>
                                <td>{{$member->member->fname ?? ''}}</td>
                                <td>{{$member->member->ihrm_no ?? ''}}</td>
                                <td>{{date('d-M-Y',strtotime($member->created_at)) ?? ''}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!--end reponsive table-->

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
                            var html = "<option value=\"All\">All</option>";
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