<div class="left-side-menu left-side-menu-dark">
    <div class="slimscroll-menu"><!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li><a href="{{url('/dashboard')}}" class="{{Request::is('dashboard') ? 'active' :''}}"><i class="mdi mdi-view-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="{{url('/dashboard/enroll')}}" class="{{Request::is('dashboard/enroll') ? 'active' :''}}"><i class="mdi mdi-atom"></i> <span> Take Course Units</span></a></li>
                <li><a href="{{url('/dashboard/units')}}" class="{{Request::is('dashboard/units') ? 'active' :''}}"><i class="mdi mdi-file-document-box"></i> <span>My Course Units</span></a></li>
                {{--<li><a href="{{url('/dashboard/cert')}}" class="{{Request::is('dashboard/cert') ? 'active' :''}}"><i class="mdi mdi-buffer"></i> <span>My Transcripts</span></a></li>--}}
                <li><a href="{{url('/member/result-slip')}}" class="{{Request::is('member/result-slip') ? 'active' :''}}"><i class="mdi mdi-approval"></i> <span>My Result Slip</span></a></li>
                <li><a href="{{url('/member/certificate')}}" class="{{Request::is('member/certificate') ? 'active' :''}}"><i class="mdi mdi-certificate"></i> <span>My Certificates</span></a></li>
                <li><a href="{{url('/dashboard/payments')}}" class="{{Request::is('dashboard/payments') ? 'active' :''}}"><i class="mdi  mdi-cash-usd"></i> <span>My Payments</span></a></li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
