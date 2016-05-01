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
        <link href="{{asset('styles/style.css')}}" rel="stylesheet">
    </head>
    <body class="blank">
        @include('splash')
        <div class="color-line"></div>
        <div class="login-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center m-b-md">
                        <a href="{{url('/')}}"><img src="{{asset('images/logomain.png')}}" width="250px"/></a>
                    </div>
                    @yield('form')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    FoodieGuide &copy; {!! date("Y") !!}
                </div>
            </div>
        </div>
        <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendor/metisMenu/dist/metisMenu.min.js')}}"></script>
        <script src="{{asset('vendor/iCheck/icheck.min.js')}}"></script>
        <script src="{{asset('vendor/sparkline/index.js')}}"></script>
        <script src="{{asset('scripts/homer.js')}}"></script>
    </body>
</html>
