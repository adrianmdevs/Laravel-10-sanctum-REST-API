@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Take Course Units</li>
@endsection
@section('title')
    Enroll to Course Units
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                        <form role="form"  id="summation" action="{{url('/dashboard/enroll')}}" method="post">
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
                            <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th class="mr-3" scope="col">COURSE</th>
                                    <th scope="col">AMOUNT PAYABLE</th>
                                    <th scope="col">MPESA PAY BILL NO.</th>
                                    <th scope="col">ACCOUNT No.</th>
                                    <th scope="col">MPESA REF. CODE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <select name="course_id" class="form-control  mr-3">
                                            <option value="">--Choose Course --</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id ?? ''}}">{{$course->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="amount" id="amount_payable" readonly
                                               class=" form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="paybill" value="850313" readonly
                                               class=" form-control text-dark text-lg-center" >
                                    </td>
                                    <td>
                                        <input type="text" name="IDNO" value="Your ID Number" readonly
                                               class=" form-control text-dark text-lg-center">
                                    </td>
                                    <td>
                                        <input type="text" name="mpesa_ref_no" placeholder="Mpesa reference Code"
                                               required
                                               class=" form-control is-invalid" autofocus>
                                    </td>
                                    {{--<input type="hidden" name="course_id" id="cert_no">--}}
                                </tr>
                                </tbody>
                            </table>
                            </div><!-- end table-responsive-->
                            <div class="table-responsive" style="overflow: scroll; max-height: 200px; width:100%;">
                                <table class="table table-bordered table-sm" id="table-data">
                                    <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Unit Name</th>
                                        <th>Unit Code</th>
                                        <th>Cost</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="member_id" value="{{Auth::user()->member->id}}">
                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg" id="enroll" style="display:none;">Enroll
                                </button>
                            </div>
                        </form>
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
                        url: '/dashboard/enroll/course/' + courseId,
                        type: "GET",
                        data: {
                            member_id: '{{Auth::user()->member->id}}',
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data.length);
                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                                html += '<tr>' +
                                    //                                    '<td>' + data[i].id + '</td>' +
                                    '<td><input type="checkbox" id="cb2" name="unit_id[]" value="' + data[i].id + '" data-amount="' + data[i].price + '"/></td> ' +
                                    '<td>' + data[i].name + '</td>' +
                                    '<td>' + data[i].unit_code + '</td>' +
                                    '<td> KShs. ' + data[i].price.toLocaleString() + '</td>' +
                                    '</tr>';
                                
                            }
                            $("#table-data").find('tbody').html(html);
                            if (data.length>0) {
                                $('#cert_no').val(courseId);
                                $('#enroll').show();
                            }
                            else{
                                $('#cert_no').val('');
                              $('#enroll').hide(); 
                              swal({ 
                                  text: "Seems like you have already enrolled to all units available to this course!",
                                   type: "info",
                               confirmButtonClass: "btn btn-confirm mt-2" 
                            }) ;
                            }
                            function calc() {
                                var sum = 0;
                                $('#summation :checkbox:checked').each(function() {
                                    sum += parseInt($(this).data("amount"));
                                });
                                $('#amount_payable').val(sum);
                            }
                            $(function() {
                                $('#summation input:checkbox').on("click",function() {
                                    calc(); //
                                });
                                calc(); // initialise in case the page is reloaded.
                            });
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
    <script>

    </script>
@endsection
