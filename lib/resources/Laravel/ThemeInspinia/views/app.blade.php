<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GroWise</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    @yield('pagestyles')
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <img src="{{asset('img/profile_small.png')}}"/>
                    </div>
                    <div class="logo-element">
                        <img src="{{asset('img/profile_mini.png')}}"/>
                    </div>
                </li>
                @yield('navigation')
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{url('logout')}}">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')
        </div>
        <div class="footer">
            <div>
                Plantforum &copy; {!! date("Y") !!}
            </div>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>
@yield('pagescripts')
</body>
</html>