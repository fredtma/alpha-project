<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GroWise</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1><img src="{{asset('img/logo.png')}}"/></h1>
            </div>
            @yield('form')
            <p class="m-t"> <small>Plantforum &copy; {!! date("Y") !!}</small> </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
