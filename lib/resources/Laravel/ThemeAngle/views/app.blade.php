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
   <!-- ANIMATE.CSS-->
   <link href="{{asset('vendor/animate.css/animate.min.css')}}" rel="stylesheet">   
   <!-- WHIRL (spinners)-->
   <link href="{{asset('vendor/whirl/dist/whirl.css')}}" rel="stylesheet">   
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" id="bscss">   
   <!-- =============== APP STYLES ===============-->
   <link href="{{asset('css/app.css')}}" rel="stylesheet">   
   <link href="{{asset('vendor/sweetalert/lib/sweet-alert.css')}}" rel="stylesheet">
   @yield('pagestyles')
</head>
<body>
   <div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a href="{{url('dashboard')}}" class="navbar-brand">
                  <div class="brand-logo">
                     <img src="{{asset('img/logo.png')}}" class="img-responsive">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img src="{{asset('img/logo-single.png')}}" class="img-responsive">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
               <!-- START Left navbar-->
               <ul class="nav navbar-nav">
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon" style="font-size:18px;"></em>
                     </a>
                     <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                     <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon" style="font-size:18px;"></em>
                     </a>
                  </li>
               </ul>
               <!-- END Left navbar-->
               <!-- START Right Navbar-->
               <ul class="nav navbar-nav navbar-right">
                  <!-- Search icon-->
                  <!--<li>
                     <a href="#" data-search-open="">
                        <em class="icon-magnifier"></em>
                     </a>
                  </li>-->
                  <!-- START Offsidebar button-->
                  <li>
                     <a href="{{url('logout')}}">
                        <em class="icon-logout" style="font-size:18px;"></em>
                     </a>
                  </li>
                  <!-- END Offsidebar menu-->
               </ul>
               <!-- END Right Navbar-->
            </div>
            <!-- END Nav wrapper-->
            <!-- START Search form-->
            <!--<form role="search" action="search.html" class="navbar-form">
               <div class="form-group has-feedback">
                  <input type="text" placeholder="Type and hit enter ..." class="form-control">
                  <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
               </div>
               <button type="submit" class="hidden btn btn-default">Submit</button>
            </form>-->
            <!-- END Search form-->
         </nav>
         <!-- END Top Navbar-->
      </header>
      <!-- sidebar-->
	  @yield('navigation')
      <!-- offsidebar-->

      <!-- Main section-->
      <section>
         @yield('content')
      </section>
      <!-- Page footer-->
      <footer>
         <span>ThoughtPoint &copy; {!! date("Y") !!}</span>
      </footer>
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
   <!-- JQUERY EASING-->
   <script src="{{asset('vendor/jquery.easing/js/jquery.easing.js')}}"></script>
   <!-- ANIMO-->
   <script src="{{asset('vendor/animo.js/animo.js')}}"></script>
   <script src="{{asset('vendor/sweetalert/lib/sweet-alert.js')}}"></script>
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- =============== APP SCRIPTS ===============-->
   <script src="{{asset('js/app.js')}}"></script>
   @yield('pagescripts')
</body>
</html>