<!-- jQuery  -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<!-- KNOB JS -->
<script src="{{asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- Chart JS -->
<script src="{{asset('assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Datatable js -->
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/libs/mohithg-switchery/switchery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<!-- Mask input -->
<script src="{{asset('assets/libs/jquery-mask-plugin/jquery.mask.min.js')}}"></script>
<!-- Bootstrap Select -->
<script src="{{asset('assets/libs/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- Parsley js -->
<script type="text/javascript" src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Init Js file -->
<script src="{{asset('assets/js/jquery.select-all.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.sweet-alert.init.js')}}"></script>
<script src="{{asset('assets/js/jquery.form-advanced.js')}}"></script>
<script src="{{asset('assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
<!--wizard initialization-->
<!-- App js -->
<script src="{{asset('assets/js/jquery.app.js')}}"></script>
{{--
<script src="{{asset('dist/assets/js/toastr.min.js')}}"></script>--}}
<script>
    {{--toastr.options = {--}}
    {{--"closeButton": true,--}}
    {{--"debug": false,--}}
    {{--"newestOnTop": false,--}}
    {{--"progressBar": true,--}}
    {{--"positionClass": "toast-top-right",--}}
    {{--"preventDuplicates": true,--}}
    {{--"showDuration": "300",--}}
    {{--"hideDuration": "1000",--}}
    {{--"timeOut": "5000",--}}
    {{--"extendedTimeOut": "1000",--}}
    {{--"showEasing": "swing",--}}
    {{--"hideEasing": "linear",--}}
    {{--"showMethod": "fadeIn",--}}
    {{--"hideMethod": "fadeOut"--}}
    {{--}--}}

    {{--@if(Session::has('success'))--}}
    {{--toastr.success("{{ Session::get('success') }}");--}}
    {{--@endif--}}


    {{--@if(Session::has('info'))--}}
    {{--toastr.info("{{ Session::get('info') }}");--}}
    {{--@endif--}}
    {{--@if(Session::has('warning'))--}}
    {{--toastr.warning("{{ Session::get('warning') }}");--}}
    {{--@endif--}}
    {{--@if(Session::has('error'))--}}
    {{--toastr.error("{{ Session::get('error') }}");--}}
    {{--@endif--}}

    //    swal({
    //        title: "Good job!",
    //        text: "You clicked the button!",
    //        type: "success",
    //        confirmButtonClass: "btn btn-confirm mt-2"
    //    })
    @if(Session::has('enrolled'))
    swal({
        html: "You have successfully enrolled in the unit(s), once admin approves you will be able to view the units under : </br><a style=\"color:red;\" href=\"http://ihrm-customer.io/dashboard/units\">My Course units menu</a>",
        type: "success",
        confirmButtonClass: "btn btn-confirm mt-2"
    });
    @endif
    @if(Session::has('success'))
    swal({
        text: "{{ Session::get('success') }}",
        type: "success",
        confirmButtonClass: "btn btn-confirm mt-2"
    });

    @endif

    @if(Session::has('info'))
    swal({
        text: "{{ Session::get('info') }}",
        type: "info",
        confirmButtonClass: "btn btn-confirm mt-2"
    })

    @endif
    @if(Session::has('warning'))
    swal({
        text: "{{ Session::get('warning') }}",
        type: "warning",
        confirmButtonClass: "btn btn-confirm mt-2"
    })
    @endif
    @if(Session::has('error'))
    swal({
        text: "{{ Session::get('error') }}",
        type: "error",
        confirmButtonClass: "btn btn-confirm mt-2"
    })
    @endif

</script>
<script>
    $(document).ready(function () {
        // Default Datatable
        $("#datepicker-autoclose").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $("#datepicker-autoclose1").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $("#datepicker-autoclose2").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $("#datepicker-autoclose3").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $("#datepicker-autoclose4").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $("#datepicker-autoclose5").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $("#datepicker-autoclose6").datepicker({autoclose: !0, todayHighlight: !0, format: 'yyyy-mm-dd'});
        $('#datatable').DataTable({
            "pageLength": 5,
            "searching": true,
            "lengthChange": true
        });
        $('form').parsley();
    });

</script>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $(document).ready(function () {
        $.selectall('#selectall', '.case');
    });

</script>

@yield('scripts')
