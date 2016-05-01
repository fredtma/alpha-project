<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SnapReview</title>
    <link rel="shortcut icon" type="image/ico" href="{{asset('favicon.ico')}}" />
    <link href="{{asset('vendor/fontawesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/metisMenu/dist/metisMenu.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/animate.css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet">
    <link href="{{asset('fonts/pe-icon-7-stroke/css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('styles/style.css')}}" rel="stylesheet">    
</head>
<body class="landing-page">
@include('splash')
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="{{asset('images/snapreviewmain.png')}}" height="45px" style="padding-top: 10px; padding-left: 10px;"/>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a class="page-scroll" href="#page-top">Home</a></li>
                <li><a class="page-scroll" page-scroll href="#components">UI</a></li>
                <li><a class="page-scroll" page-scroll href="#features">Features</a></li>
                <li><a class="page-scroll" page-scroll href="#team">Team</a></li>
                <li><a class="page-scroll" page-scroll href="#pricing">Pricing </a></li>
                <li><a class="page-scroll" page-scroll href="#contact">Contact</a></li>                
                <li><a class="page-scroll" page-scroll href="#clients">Login </a></li>
            </ul>
        </div>
    </div>
</nav>
<header id="page-top">
    <div class="container">
        <div class="heading">
            <h1 style="color: #6A6C6F;">
                Welcome to SnapReview
            </h1>
            <span>Contrary to popular belief, Lorem Ipsum is not<br/> simply random text for print.</span>
            <p class="small">
                SnapReview tag line
            </p>
            <a href="#" class="btn btn-success btn-sm">Learn more</a>
        </div>
        <div class="heading-image animate-panel" data-child="img-animate" data-effect="fadeInRight">
            <p class="small">SnapReview tag line</p>
            <img class="img-animate" src="images/landing/c1.jpg">
            <img class="img-animate" src="images/landing/c2.jpg">
            <img class="img-animate" src="images/landing/c3.jpg">
            <br/>
            <img class="img-animate" src="images/landing/c5.jpg">
            <img class="img-animate" src="images/landing/c6.jpg">
            <img class="img-animate" src="images/landing/c7.jpg">
        </div>
    </div>
</header>
<section>
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <h4>HTML5 & CSS3</h4>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link btn btn-sm" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-md-4">
            <h4>Staggering Animations</h4>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of.</p>
            <p><a class="navy-link btn btn-sm" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-md-4">
            <h4>Unique Dashboard</h4>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
            <p><a class="navy-link btn btn-sm" href="#" role="button">Learn more</a></p>
        </div>
    </div>
    </div>
</section>

<section id="components" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><span class="text-success">UI components </span>for your app</h2>
                <p>Lorem Ipsum available, but the majority have suffered alteration euismod. </p>
            </div>
        </div>
        <div class="row m-t-md">
            <div class="col-md-6">
                <h4 class="m-t-xxxl">Special contacts view</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum.</p>
            </div>
            <div class="col-md-6">
                <img src="images/landing/s2.png" class="img-responsive">
            </div>
        </div>
        <div class="row m-t-xl">
            <div class="col-md-6">
                <img src="images/landing/s4.png" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h4 class="m-t-xxl">Additional analytical components</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum.</p>
            </div>
        </div>
        <div class="row  m-t-xl">
            <div class="col-md-6">
                <h4 class="m-t-xxl">Special designed project view</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum.</p>
            </div>
            <div class="col-md-6">
                <img src="images/landing/s1.png" class="img-responsive">
            </div>
        </div>
        <div class="row m-t-xl">
            <div class="col-md-6">
                <img src="images/landing/s3.png" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h4 class="m-t-xxl">Many widets components</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum.</p>
            </div>
        </div>
    </div>
</section>

<section id="features">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <h2><span class="text-success">Many features to </span>discover with Homer</h2>
                <p>
                    Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes.
                </p>
            </div>
        </div>
        <div class="row m-t-lg">
            <div class="col-md-4 col-md-offset-2">
                <strong>Donec sed odio dui.</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <a class="btn btn-success btn-sm">Learn more</a>
            </div>
            <div class="col-md-4">
                <strong>Lorem Ipsum as their.</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <a class="btn btn-success btn-sm">Learn more</a>
            </div>
        </div>
        <div class="row m-t-lg">
            <div class="col-md-4 col-md-offset-2">
                <strong>Donec sed odio dui.</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <a class="btn btn-success btn-sm">Learn more</a>
            </div>
            <div class="col-md-4">
                <strong>Lorem Ipsum as their.</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <a class="btn btn-success btn-sm">Learn more</a>
            </div>
        </div>
    </div>
</section>

<section id="features2" class="bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <h2><span class="text-success">Special icons </span>for your app</h2>
                <p>Lorem Ipsum available, but the majority have suffered alteration euismod. </p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-airplay text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-science text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-display1 text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-cloud-upload text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-global text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-battery text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-users text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
            <div class="col-md-3">
                <h4 class="m-t-lg"><i class="pe-7s-ticket text-success icon-big"></i></h4>
                <strong>Lorem Ipsum available</strong>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
            </div>
        </div>

    </div>
</section>

<section id="team">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2><span class="text-success">Our team </span>support you</h2>
                <p>
                    Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes.
                </p>
            </div>
        </div>

        <div class="row m-t-lg text-center">
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="images/a2.jpg" class="img-circle img-small" alt="">
                    <h4><span>User</span> name</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus. </p>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="images/a5.jpg" class="img-circle" alt="">
                    <h4><span>User</span> name</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="images/a3.jpg" class="img-circle img-small" alt="">
                    <h4><span>User</span> name</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>

                </div>
            </div>
        </div>
        <div class="row m-t-lg text-center">
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="images/a7.jpg" class="img-circle img-small" alt="">
                    <h4><span>User</span> name</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus. </p>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="images/a8.jpg" class="img-circle" alt="">
                    <h4><span>User</span> name</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="images/a9.jpg" class="img-circle img-small" alt="">
                    <h4><span>User</span> name</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>

                </div>
            </div>
        </div>

    </div>
</section>


<section id="pricing" class="bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <h2><span class="text-success">Best pricing </span>for your app</h2>
                <p>Lorem Ipsum available, but the majority have suffered alteration euismod. </p>
            </div>
        </div>

        <div class="row m-t-lg">
            <div class="col-lg-3">
                <ul class="pricing-plan list-unstyled">
                    <li class="pricing-title">
                        Basic
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$16</span>
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li>
                        <a class="btn btn-primary btn-sm" href="#">Signup today</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <ul class="pricing-plan list-unstyled selected">
                    <li class="pricing-title">
                        Standard
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$22</span>
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li class="plan-action">
                        <a class="btn btn-primary btn-sm" href="#">Signup today</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <ul class="pricing-plan list-unstyled">
                    <li class="pricing-title">
                        Premium
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$160</span>
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li>
                        <a class="btn btn-primary btn-sm" href="#">Signup today</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <ul class="pricing-plan list-unstyled">
                    <li class="pricing-title">
                        Prestige
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$260</span>
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li>
                        <a class="btn btn-primary btn-sm" href="#">Signup today</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</section>
<section id="clients">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2><span class="text-success">Our best</span> clients</h2>
                <p>
                    Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes.
                </p>
            </div>
        </div>

        <div class="row text-center m-t-lg">
            <div class="col-md-6 col-md-offset-3">

                <div class="row">

                    <div class="col-md-6">
                        <div class="client">Company logo</div>
                    </div>
                    <div class="col-md-6">
                        <div class="client">Company logo</div>
                    </div>
                    <div class="col-md-6">
                        <div class="client">Company logo</div>
                    </div>
                    <div class="col-md-6">
                        <div class="client">Company logo</div>
                    </div>
                    <div class="col-md-6">
                        <div class="client">Company logo</div>
                    </div>
                    <div class="col-md-6">
                        <div class="client">Company logo</div>
                    </div>

                </div>


            </div>

        </div>


    </div>
</section>
<section id="contact" class="bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2><span class="text-success">Contact with us</span> anytime</h2>
                <p>
                    Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes.
                </p>
            </div>
        </div>
        <div class="row text-center m-t-lg">
            <div class="col-md-4 col-md-offset-3">
                <form class="form-horizontal" role="form" method="post" action="#">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Message</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="message"  placeholder="Your message here..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="submit" name="submit" type="submit" value="Send us a message" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 text-left">
                <address>
                    <strong><span class="navy">Company name, Inc.</span></strong><br/>
                    601 Street name, 123<br/>
                    New York, De 34101<br/>
                    <abbr title="Phone">P:</abbr> (123) 678-8674
                </address>
                <p class="text-color">
                    Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis, totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                </p>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/metisMenu/dist/metisMenu.min.js')}}"></script>
<script src="{{asset('vendor/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('vendor/sparkline/index.js')}}"></script>
<script src="{{asset('scripts/homer.js')}}"></script>
<script>
    $(document).ready(function () {
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
        });
        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });
    });
</script>
</body>
</html>