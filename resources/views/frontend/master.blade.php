<!doctype html>
<html lang="en">
  <head>
    <base href="{{ asset('') }}">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="frontend/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/css/animate.css">
    <link rel="stylesheet" href="frontend/css/owl.carousel.min.css">

    <link rel="stylesheet" href="frontend/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="frontend/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="frontend/fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="frontend/css/style.css">
  </head>
  <body>
    

    <div class="wrap">

      @include('frontend.partials.header')

      @yield('slider')
      <!-- END section -->

      <section class="site-section py-sm">
        <div class="container">
          @yield('lastest-home')
          <div class="row blog-entries">
            @yield('content')

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">
              @include('frontend.partials.popular')

              @include('frontend.partials.categories')

              @include('frontend.partials.tags')
            </div>
            <!-- END sidebar -->
          </div>
        </div>
      </section>
    
      @include('frontend.partials.footer')
      <!-- END footer -->

    </div>
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="frontend/js/jquery-3.2.1.min.js"></script>
    <script src="frontend/js/jquery-migrate-3.0.0.js"></script>
    <script src="frontend/js/popper.min.js"></script>
    <script src="frontend/js/bootstrap.min.js"></script>
    <script src="frontend/js/owl.carousel.min.js"></script>
    <script src="frontend/js/jquery.waypoints.min.js"></script>
    <script src="frontend/js/jquery.stellar.min.js"></script>
    
    <script src="frontend/js/main.js"></script>
  </body>
</html>