<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <title>ThoughtPoint</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link href="{{asset('vendor/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet">
   <!-- SIMPLE LINE ICONS-->
   <link href="{{asset('vendor/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" id="bscss">   
   <!-- =============== APP STYLES ===============-->
   <link href="{{asset('css/app.css')}}" rel="stylesheet" id="maincss">     
</head>
<body>
   <div class="wrapper">
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->
         <div class="panel panel-dark panel-flat" style="margin-bottom:0px;">
            <div class="panel-heading text-center" style="background-color:#43c2e9;">
               <a href="{{url('/')}}">
                  <img src="{{asset('img/logo.png')}}" class="block-center img-rounded">
               </a>
            </div>
            <div class="panel-body">
	            @yield('form')   
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span>ThoughtPoint &copy; {!! date("Y") !!}</span>
         </div>
      </div>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="{{asset('vendor/modernizr/modernizr.custom.js')}}"></script>
   <!-- JQUERY-->
   <script src="{{asset('vendor/jquery/dist/jquery.js')}}"></script>
   <!-- BOOTSTRAP-->
   <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.js')}}"></script>
   <!-- STORAGE API-->
   <script src="{{asset('vendor/jQuery-Storage-API/jquery.storageapi.js')}}"></script>
   <!-- PARSLEY-->
   <script src="{{asset('vendor/parsleyjs/dist/parsley.min.js')}}"></script>
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- =============== APP SCRIPTS ===============-->
   <script src="{{asset('js/app.js')}}"></script>   
</body>
</html>