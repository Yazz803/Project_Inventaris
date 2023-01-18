<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Inventory Management</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets/landingpagebaru/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpagebaru/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpagebaru/css/main.css') }}">

    <!-- script
    ================================================== -->
    <script src="{{ asset('assets/landingpagebaru/js/modernizr.js') }}"></script>
    <script src="{{ asset('assets/landingpagebaru/js/pace.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- header
    ================================================== -->
    <header class="s-header">
        <nav class="header-nav">

            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

            <div class="header-nav__content">
                <h3>Navigation</h3>

                <ul class="header-nav__list">
                    @guest
                        @if (Route::is('landingpage.index'))
                            <li class="current"><a class="smoothscroll" href="#home" title="home">Home</a></li>
                            <li><a class="smoothscroll" href="#about" title="about">About</a></li>
                            <li><a class="smoothscroll" href="#services" title="services">Services</a></li>
                            <li><a class="smoothscroll" href="#works" title="works">Works</a></li>
                        @else
                            <li class="current"><a href="/" title="home">Home</a></li>
                        @endif
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}" title="contact">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        @if (Route::is('landingpage.index'))
                            <li class="current"><a class="smoothscroll" href="#home" title="home">Home</a></li>
                            <li><a class="smoothscroll" href="#about" title="about">About</a></li>
                            <li><a class="smoothscroll" href="#services" title="services">Services</a></li>
                            <li><a class="smoothscroll" href="#works" title="works">Works</a></li>
                        @else
                            <li class="current"><a href="/" title="home">Home</a></li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" title="contact">{{ __('Logout') }}</a>
                        </li>

                    </ul>
                    <p>{{ Auth::user()->name }}</p>
                @endguest

                <ul class="header-nav__social">
                    <li>
                        <a href="https://www.instagram.com/smkwikrama/"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                    </li>
                    <li>
                        <a href="https://smkwikrama.sch.id/"><i class="fa fa-globe" aria-hidden="true"></i><span>Website</span></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/@multimediawikrama7482"><i class="fa fa-youtube" aria-hidden="true"></i><span>Youtube</span></a>
                    </li>
                </ul>

            </div> <!-- end header-nav__content -->

        </nav> <!-- end header-nav -->

        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-text">Menu</span>
            <span class="header-menu-icon"></span>
        </a>

    </header> <!-- end s-header -->

    @yield('content')

    <!-- footer
                                                                                ================================================== -->
    <footer>

        <div class="row footer-main">

            <div class="col-six tab-full left footer-desc">

                <h4>Inventory Management</h4>
                Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Praesent sapien
                massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh
                pulvinar a. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Quaerat voluptas
                autem necessitatibus vitae aut.

            </div>

            <div class="col-six tab-full right footer-subscribe">

                <h4>Get Notified</h4>
                <p>Quia quo qui sed odit. Quaerat voluptas autem necessitatibus vitae aut non alias sed quia. Ut itaque
                    enim optio ut excepturi deserunt iusto porro.</p>

                <div class="subscribe-form">
                    <form id="mc-form" class="group" novalidate="true">
                        <input type="email" value="" name="EMAIL" class="email" id="mc-email"
                            placeholder="Email Address" required="">
                        <input type="submit" name="subscribe" value="Subscribe">
                        <label for="mc-email" class="subscribe-message"></label>
                    </form>
                </div>

            </div>

        </div> <!-- end footer-main -->

        <div class="row footer-bottom">

            <div class="col-twelve">
                <div class="copyright">
                    <span>© Copyright Kevin Yardan Fauzan | Muhammad Yazid Akbar {{ date('Y') }}</span>
                </div>

                <div class="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up"
                            aria-hidden="true"></i></a>
                </div>
            </div>

        </div> <!-- end footer-bottom -->

    </footer> <!-- end footer -->


    <!-- photoswipe background
                                                                                ================================================== -->
    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                        title="Close (Esc)"></button> <button class="pswp__button pswp__button--share"
                        title="Share"></button> <button class="pswp__button pswp__button--fs"
                        title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom"
                        title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div> <!-- end photoSwipe background -->


    <!-- preloader
                                                                                ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale-pulse-out">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>


    <!-- JavaScript  ================================================== -->
    <script src="{{ asset('assets/landingpagebaru/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/landingpagebaru/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/landingpagebaru/js/main.js') }}"></script>

</body>

</html>
