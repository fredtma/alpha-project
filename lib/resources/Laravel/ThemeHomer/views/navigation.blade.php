<?php
$user = Sentinel::findById(Auth::user()->id);
?>
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            <img src="{{asset('images/profile.png')}}" style="padding-bottom: 5px;"/>
            <div class="stats-label text-color">
                <span class="font-extra-bold">{{Auth::user()->firstname. ' ' .Auth::user()->lastname}}</span>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <small class="text-muted">User Profile <b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{url('profile')}}">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('logout')}}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            @if($user->hasAccess(['dashboard']))
            @if(in_array('dashboard',$view))
            <li class="active">
                @else
            <li>
                @endif
                <a href="{{url('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @endif
            {{--_NavBar_--}}



        </ul>
    </div>
</aside>