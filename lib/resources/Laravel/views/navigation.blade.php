<?php
$user = Sentinel::findById(Auth::user()->id);
?>
<aside class="aside">
    <!-- START Sidebar (left)-->
    <div class="aside-inner">
        <nav data-sidebar-anyclick-close="" class="sidebar">
            <!-- START sidebar nav-->
            <ul class="nav">
                <!-- Iterates over all sidebar items-->
                <li class="nav-heading ">
                    <span>Navigation</span>
                </li>
                @if($user->hasAccess(['dashboard']))
                @if(in_array('dashboard',$view))
                <li class="active">
                    @else
                <li>
                    @endif
                    <a href="{{url('dashboard')}}"><em class="fa fa-th-large"></em> <span>Dashboard</span></a>
                </li>
                @endif
{{--_NavBar_--}}
            </ul>
            <!-- END sidebar nav-->
        </nav>
    </div>
    <!-- END Sidebar (left)-->
</aside>
