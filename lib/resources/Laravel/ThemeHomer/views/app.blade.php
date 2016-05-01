<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FoodieGuide</title>
        <link rel="shortcut icon" type="image/ico" href="{{asset('favicon.ico')}}" />
        <link href="{{asset('vendor/fontawesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/metisMenu/dist/metisMenu.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/animate.css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet">
        <link href="{{asset('fonts/pe-icon-7-stroke/css/helper.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/sweetalert/lib/sweet-alert.css')}}" rel="stylesheet">
        <link href="{{asset('styles/style.css')}}" rel="stylesheet">
        @yield('pagestyles')
    </head>
    <body>
        @include('splash')
        <div id="header">
            <div class="color-line">
            </div>
            <div id="logo" class="light-version">
                <span>
                    <img src="{{asset('images/logo.png')}}" width="150px"/>
                </span>
            </div>
            <nav role="navigation">
                <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
                <div class="small-logo">
                    <img src="{{asset('images/logomobile.png')}}" width="220px"/>
                </div>
                <!--@include('mobilemenu')-->
                <div class="navbar-right">
                    <ul class="nav navbar-nav no-borders">
                        <!--@include('notifications')
                        @include('shortcuts')
                        @include('messages')
                        <li>
                            <a href="#" id="sidebar" class="right-sidebar-toggle">
                                <i class="pe-7s-upload pe-7s-news-paper"></i>
                            </a>
                        </li>-->
                        <li class="dropdown">
                            <a href="{{url('logout')}}"><i class="pe-7s-upload pe-rotate-90"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        @yield('navigation')
        <div id="wrapper">
            @yield('content')
            @include('rightsidebar')
            <footer class="footer">
                FoodieGuide &copy; {!! date("Y") !!}
            </footer>
        </div>
        <script src="{{asset('vendor/sweetalert/lib/sweet-alert.js')}}"></script>
        <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendor/metisMenu/dist/metisMenu.min.js')}}"></script>
        <script src="{{asset('vendor/iCheck/icheck.min.js')}}"></script>
        <script src="{{asset('vendor/sparkline/index.js')}}"></script>
        <script src="{{asset('scripts/homer.js')}}"></script>
        @yield('pagescripts')
    </body>
</html>
