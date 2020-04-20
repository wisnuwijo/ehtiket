<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Browse &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/home/browse/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('public/home/browse/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/home/browse/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/home/browse/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('public/home/browse/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/home/browse/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/home/browse/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('public/home/browse/fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('public/home/browse/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('public/home/browse/css/rangeslider.css') }}">

    <link rel="stylesheet" href="{{ asset('public/home/browse/css/style.css') }}">

  </head>
    <style>
        .convert-to-white {
            font-size: 0.875rem;
            font-weight: 600;
            filter: brightness(5);
            text-transform: uppercase;
            font-size: .875rem;
            letter-spacing: .05px;
        }

    </style>
    @yield('custom-css')
  <body>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-11 col-xl-2">
            <h1 class="mb-0 site-logo">
                <a href="{{ url('/') }}" class="text-white h2 mb-0">
                    <img src="{{ asset('public/argon/img/brand/white.png') }}" class="" alt="">
                </a>
            </h1>
          </div>
          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>

    </header>

    <div class="site-section">
      <div class="container">
          @yield('plain-content')
      </div>
    </div>
  </div>

  <script src="{{ asset('public/home/browse/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/aos.js') }}"></script>
  <script src="{{ asset('public/home/browse/js/rangeslider.min.js') }}"></script>

  <script src="{{ asset('public/home/browse/js/main.js') }}"></script>
  @yield('js')

  </body>
</html>
