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
                    <img src="{{ asset('public/argon/img/brand/white.png') }}" class="convert-to-white" alt="">
                </a>
            </h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            @include('layouts.parts.landing-nav')
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>

    </header>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-color: #45a6c5;" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>@yield('event-title')</h1>
                <p data-aos="fade-up" data-aos-delay="100">By @yield('event-host')<span class="mx-3">&bullet;</span>@yield('event-createdAt')</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
          <div class="card" style="width: 100%;margin-top:-10rem">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 style="font-weight:bold">Tentang Acara</h6>
                            <p class="card-text">{!! $event->event_info !!}</p>
                            <br>
                            <button class="btn btn-xs btn-info">{{ $event->event_subscription }}</button>
                        </div>
                        <div class="col-md-4">
                            <h6 style="font-weight:bold">Tanggal Dan Waktu</h6>
                            <p class="card-text">{{ formatDate($event->event_start) }} - {{ formatDate($event->event_finish) }}</p>
                            <br>
                            <h6 style="font-weight:bold">Lokasi</h6>
                            <p class="card-text">{{ $event->event_place }}</p>

                            @yield('event-ticket-class')
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
          <div class="col-md-12">
              <p>@yield('event-info')</p>
          </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <iframe src="https://maps.google.com/maps?q={{ $event->event_latitude }},{{ $event->event_longitude }}&hl=id&z=15&amp;output=embed" frameborder="0" style="width:100%;height:400px"></iframe>
            </div>
        </div>

      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Products</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Features</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <form action="#" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5">
          <div class="col-12 text-md-center text-left">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>
  @yield('more-elements')
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
