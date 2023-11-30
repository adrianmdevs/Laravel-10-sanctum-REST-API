@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/learners')}}">Learners</a></li>
    <li class="breadcrumb-item active">Enroll Learner</li>
@endsection
@section('title')
    Enroll {{$member->fname ?? 'Learner'}}
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
                           class="nav-link active ">Enroll</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/course-units/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link">Course Units</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/payments/'.$member->id)}}" aria-expanded="true"
                                            class="nav-link">Payments</a></li>
                    <li class="nav-item"><a href="{{url('/admin/learners/certificates/'.$member->id)}}"
                                            aria-expanded="true"
                                            class="nav-link">Certificates</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <form role="form" action="{{url('/admin/learners/enroll/'.$member->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="hidden" name="member_id" value="{{$member->id}}">
                                    <div class="form-group">

                                        <label for="form-username">Mpesa Code</label>
                                        <input type="text" name="mpesa_ref_no" placeholder="Mpesa reference Code"
                                               required
                                               class=" form-control">
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Course <span class="text-danger">*</span></label>
                                        <select name="course_id" class="form-control select2">
                                            <option value="">--Choose Course --</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id ?? ''}}">{{$course->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->


                            {{--<table border="1" id="table-data">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                            {{--<th><input type="checkbox" id="allcb" name="allcb"/></th>--}}
                            {{--<th>values</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                            {{--<td><input type="checkbox" id="cb1" name="cb1"/></td>--}}
                            {{--<td>value1</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td><input type="checkbox" id="cb2" name="cb2"/></td>--}}
                            {{--<td>value2</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td><input type="checkbox" id="cb3" name="cb3"/></td>--}}
                            {{--<td>value3</td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                            {{--</table>--}}
                            <div class="table-responsive" style="overflow: scroll; max-height: 200px; width:100%;">
                                <table class="table table-bordered table-sm" id="table-data">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="allcb"/></th>
                                        <th>Unit Name</th>
                                        <th>Unit Code</th>
                                        <th>Cost</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg">Enroll Learner
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#allcb').change(function () {
            if ($(this).prop('checked')) {
                $('tbody tr td input[type="checkbox"]').each(function () {
                    $(this).prop('checked', true);
                });
            } else {
                $('tbody tr td input[type="checkbox"]').each(function () {
                    $(this).prop('checked', false);
                });
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="course_id"]').on('change', function (event) {
                var courseId = $(this).val();
                if (courseId) {
                    $.ajax({
                        url: '/admin/learners/enroll/course/' + courseId,
                        type: "GET",
                        data: {
                            member_id: '{{$member->id}}',
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                                html += '<tr >' +
                                    //                                    '<td>' + data[i].id + '</td>' +
                                    '<td><input type="checkbox" id="cb2" name="unit_id[]" value="' + data[i].id + '"/></td> ' +
                                    '<td>' + data[i].name + '</td>' +
                                    '<td>' + data[i].unit_code + '</td>' +
                                    '<td> Kshs. ' + data[i].price.toLocaleString() + '</td>' +
                                    '</tr>';
                            }
                            $("#table-data").find('tbody').html(html);


                        },

                    });

                }

                else {
                    var html = '';
                    $("#table-data").find('tbody').html(html);
                }
                event.preventDefault();
            });

        });

    </script>
@endsection
