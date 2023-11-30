<!-- header -->
@include('layouts.header')
<!-- end header -->
<body><!-- Begin page -->
<div id="wrapper">
    <!-- Navigation Bar-->
@include('layouts.navbar')
<!-- End Navigation Bar-->
    <!-- ========== Left Sidebar Start ========== -->
@include('layouts.sidebar')
<!-- Left Sidebar End -->
    <!-- Page Content Start -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid"><!-- Page title box -->
                <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                        @yield('crumbs')
                        {{--<li class="breadcrumb-item"><a href="javascript:void(0);">Greeva</a></li>--}}
                        {{--<li class="breadcrumb-item active">Dashboard</li>--}}
                    </ol>
                    <h4 class="page-title"> @yield('title')</h4>
                </div><!-- End page title box -->
                @yield('content')

            </div><!-- end container-fluid-->
        </div><!-- end content-->
    </div><!-- End Page Content-->
    <!-- Footer -->
@include('layouts.footer')
<!-- End Footer -->
</div><!-- End #wrapper -->
<!-- Scripts  -->
@include('layouts.scripts')
<!-- End Scripts  -->

</body>
</html>