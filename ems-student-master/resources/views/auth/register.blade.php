@include('layouts.header')
{{--<body class="bg-account-pages">--}}
<body  style="background: #716DEE;">
<!-- Login -->
<section>
    <div class="container">
        <div class="row">
            <div class="wrapper-page mt-5">
                <div class="col-md-6 offset-md-3 bg-white rounded-0"><!-- Logo box-->
                    <div class="account-logo-box border-bottom mt-0">
                        <h2 class="text-uppercase text-center mt-0">
                            <a href="{{ route('register') }}" class="text-success"><span><img
                                            src="{{asset('assets/images/logo22.PNG')}}" alt=""
                                            style="width:130px;height:130px;"></span></a>
                        </h2>
                    </div>
                    <div class="account-content mt-0 mb-5 pb-5">
                        <form role="form" action="{{ route('register') }}" method="post">
                            @csrf
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" placeholder="Learner's Full name"
                                               class=" form-control {{ $errors->has('fname') ? ' is-invalid' : '' }}" value="{{ old('fname') }}" required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">National ID <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" name="nid" placeholder="National ID Number"
                                               class="form-control" value="{{ old('nid') }}" required>
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Date of Birth <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" name="dob" placeholder="Date of Birth"
                                               id="datepicker-autoclose" class="form-control"
                                               autocomplete="off" required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Phone No. <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" placeholder="Enter Phone Number"
                                               class="form-control" value="{{ old('phone') }}" required>
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Email Address <span
                                                    class="text-danger">*</span></label>
                                        <input type="email" name="email" placeholder="Enter Email"
                                               class="form-control" value="{{ old('email') }}" required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">IHRM No.<span
                                                    class="text-danger">*</span></label>
                                        <input type="text" name="ihrm_no" placeholder="IHRM Number"
                                               class="form-control" value="{{ old('ihrm_no') }}" required>
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Password<span
                                                    class="text-danger">*</span></label>
                                        <input type="password" name="password" placeholder="Enter Password"
                                               class="form-control" required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form-username">Confirm Password</label>
                                        <input type="password" name="password_confirmation"
                                               placeholder="Confirm Password"
                                               class="form-control">
                                    </div>
                                </div><!--end col-->
                            </div><!-- end row-->
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-block btn-lg">JOIN NOW
                                </button>
                            </div>
                            <a href="{{ url('/')}}"
                               class="text-muted float-right mt-2">
                                <p>Have an account? <em class="flip" style="color: #0D13F5;">Click here to Login</em>
                                </p>
                            </a>
                        </form>

                        <!-- end form -->

                    </div><!-- end account-content -->

                </div><!-- end wrapper-page -->
            </div>
        </div>
        <!-- end row -->
    </div><!-- end container -->
</section><!-- END HOME -->
<!-- jQuery  -->
@include('layouts.scripts')
</body>
</html>
