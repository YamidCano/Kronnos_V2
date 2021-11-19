<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('vue') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/meanmenu.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/meanmenu.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/slick.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/default.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('vue') }}/css/responsive.css">
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader end  -->

    <!-- header start -->
    <header>
        <div id="header-sticky" class="header-area box-90">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-6 col-md-6 col-7 col-sm-5 d-flex align-items-center pos-relative">
                        <div class="basic-bar cat-toggle">
                            <span class="bar1"></span>
                            <span class="bar2"></span>
                            <span class="bar3"></span>
                        </div>
                        <div class="logo">
                            <a href="index.html"><img src="img/logo/logo.png" alt=""></a>
                        </div>

                        <div class="category-menu">
                            <h4>Category</h4>
                            <ul>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Table lamp</a></li>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Furniture</a></li>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Chair</a></li>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Men</a></li>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Women</a></li>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Cloth</a></li>
                                <li><a href="shop.html"><i class="flaticon-shopping-cart-1"></i> Trend</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-8 col-8 d-none d-xl-block">
                        <div class="main-menu text-center">
                            <nav id="mobile-menu">
                                <ul>
                                    <li>
                                        <a href="index.html">Home</a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="index.html">Home Style 1</a>
                                            </li>
                                            <li>
                                                <a href="index-2.html">Home Style 2</a>
                                            </li>
                                            <li>
                                                <a href="index-3.html">Home Style 3</a>
                                            </li>
                                            <li>
                                                <a href="index-4.html">Home Style 4</a>
                                            </li>
                                            <li>
                                                <a href="index-5.html">Home Style 5</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="shop.html">Shop</a>
                                        <ul class="submenu ">
                                            <li>
                                                <a href="#">Category View</a>
                                                <ul class="submenu  level-1">
                                                    <li>
                                                        <a href="shop.html">Shop 2 Column</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-filter.html">Shop Filter Style</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-full.html">Shop Full</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-3-col.html">Shop 3 Column</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-list.html">List View</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Category View</a>
                                                <ul class="submenu">
                                                    <li>
                                                        <a href="shop-left-sidebar.html">Sidebar Left</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-sidebar-right.html">Sidebar Right</a>
                                                    </li>
                                                    <li>
                                                        <a href="cart.html">Shopping Cart</a>
                                                    </li>
                                                    <li>
                                                        <a href="checkout.html">Checkout</a>
                                                    </li>
                                                    <li>
                                                        <a href="wishlist.html">My Wishlist</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Products Types</a>
                                                <ul class="submenu">
                                                    <li>
                                                        <a href="product-simple.html">Simple Product</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-variable.html">Variable Product</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-upcoming.html">Product Upcoming</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-up-thumb.html">Thumb Top Product</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-sidebar.html">Product Sidebar</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="shop-filter.html">Products </a>
                                    </li>
                                    <li>
                                        <a href="blog.html">Blog</a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="blog-2-col.html">Blog 2 Column</a>
                                            </li>
                                            <li>
                                                <a href="blog-2-col-mas.html">Blog 2 Col Masonry</a>
                                            </li>
                                            <li>
                                                <a href="blog-3-col.html">Blog 3 Column</a>
                                            </li>
                                            <li>
                                                <a href="blog-3-col-mas.html">Blog 3 Col Masonry</a>
                                            </li>
                                            <li>
                                                <a href="blog-details.html">Blog Details</a>
                                            </li>
                                            <li>
                                                <a href="blog-details-audio.html">Blog Details Audio</a>
                                            </li>
                                            <li>
                                                <a href="blog-details-video.html">Blog Details Video</a>
                                            </li>
                                            <li>
                                                <a href="blog-details-gallery.html">Blog Details Gallery</a>
                                            </li>
                                            <li>
                                                <a href="blog-details-left-sidebar.html">Details Left Sidebar</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Pages</a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="about.html">About Us</a>
                                            </li>

                                            <li>
                                                <a href="contact.html">Contact Us</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('login') }}">login</a>
                                            </li>
                                            <li>
                                                <a href="register.html">Register</a>
                                            </li>
                                            <li>
                                                <a href="cart.html">Shoping Cart</a>
                                            </li>
                                            <li>
                                                <a href="checkout.html">Checkout</a>
                                            </li>
                                            <li>
                                                <a href="wishlist.html">Wishlist</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 col-5 col-sm-7 pl-0">
                        <div class="header-right f-right">
                            <ul>
                                <li class="search-btn">
                                    <a class="search-btn nav-search search-trigger" href="#"><i
                                            class="fas fa-search"></i></a>
                                </li>
                                <li class="login-btn"><a href="{{ url('login') }}"><i class="far fa-user"></i></a></li>
                                <li class="d-shop-cart"><a href="#"><i class="flaticon-shopping-cart"></i> <span
                                            class="cart-count">3</span></a>
                                    <ul class="minicart">
                                        <li>
                                            <div class="cart-img">
                                                <a href="product-details.html">
                                                    <img src="img/product/pro1.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="cart-content">
                                                <h3>
                                                    <a href="product-details.html">Black & White Shoes</a>
                                                </h3>
                                                <div class="cart-price">
                                                    <span class="new">$ 229.9</span>
                                                    <span>
                                                        <del>$239.9</del>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="del-icon">
                                                <a href="#">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cart-img">
                                                <a href="product-details.html">
                                                    <img src="img/product/pro2.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="cart-content">
                                                <h3>
                                                    <a href="product-details.html">Black & White Shoes</a>
                                                </h3>
                                                <div class="cart-price">
                                                    <span class="new">$ 229.9</span>
                                                    <span>
                                                        <del>$239.9</del>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="del-icon">
                                                <a href="#">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cart-img">
                                                <a href="product-details.html">
                                                    <img src="img/product/pro3.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="cart-content">
                                                <h3>
                                                    <a href="product-details.html">Black & White Shoes</a>
                                                </h3>
                                                <div class="cart-price">
                                                    <span class="new">$ 229.9</span>
                                                    <span>
                                                        <del>$239.9</del>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="del-icon">
                                                <a href="#">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="total-price">
                                                <span class="f-left">Total:</span>
                                                <span class="f-right">$300.0</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkout-link">
                                                <a href="cart.html">Shopping Cart</a>
                                                <a class="red-color" href="checkout.html">Checkout</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 d-xl-none">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Contenido Dinamico -->
    @hasSection('content')
        <main>
            @yield('content')
        </main>
    @else
        {{ $slot }}
    @endif


    <!-- footer start -->
    <footer>
        <div class="footer-area box-90 pt-100 pb-60">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-5 col-md-6 ">
                        <div class="footer-widget mb-40">
                            <div class="footer-logo">
                                <a href="index.html"><img src="img/logo/footer-logo.png" alt=""></a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore mag na
                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat.
                            </p>
                            <div class="footer-time d-flex mt-30">
                                <div class="time-icon">
                                    <img src="img/icon/time.png" alt="">
                                </div>
                                <div class="time-text">
                                    <span>Got Questions ? Call us 24/7!</span>
                                    <h2>(0600) 874 548</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 d-lg-none d-xl-block">
                        <div class="footer-widget pl-50 mb-40">
                            <h3>Social Media</h3>
                            <ul class="footer-link">
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Twitter</a></li>
                                <li><a href="#">Behance</a></li>
                                <li><a href="#"> Dribbble</a></li>
                                <li><a href="#">Linkedin</a></li>
                                <li><a href="#">Youtube</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 d-lg-none d-xl-block">
                        <div class="footer-widget pl-30 mb-40">
                            <h3>Location</h3>
                            <ul class="footer-link">
                                <li><a href="#">New York</a></li>
                                <li><a href="#">Tokyo</a></li>
                                <li><a href="#">Dhaka</a></li>
                                <li><a href="#"> Chittagong</a></li>
                                <li><a href="#">China</a></li>
                                <li><a href="#">Japan</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="footer-widget mb-40">
                            <h3>About</h3>
                            <ul class="footer-link">
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#"> Privacy Policy</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Wholesale</a></li>
                                <li><a href="#">Direction</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-6">
                        <div class="footer-widget mb-40">
                            <div class="footer-banner">
                                <a href="shop.html"><img src="img/banner/add.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area box-105">
            <div class="container-fluid">
                <div class="copyright-border pt-30 pb-30">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="copyright text-center text-md-left">
                                <p>Copyright © 2019 <a href="#">BasicTheme</a>. All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="footer-icon text-center text-md-right ">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Fullscreen search -->
    <div class="search-wrap">
        <div class="search-inner">
            <i class="fas fa-times search-close" id="search-close"></i>
            <div class="search-cell">
                <form method="get">
                    <div class="search-field-holder">
                        <input type="search" class="main-search-input" placeholder="Search Entire Store...">
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end fullscreen search -->




    <!-- Scripts -->
    <!-- JS here -->
    <script src="{{ asset('vue') }}/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('vue') }}/js/popper.min.js"></script>
    <script src="{{ asset('vue') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('vue') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('vue') }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('vue') }}/js/one-page-nav-min.js"></script>
    <script src="{{ asset('vue') }}/js/slick.min.js"></script>
    <script src="{{ asset('vue') }}/js/jquery.meanmenu.min.js"></script>
    <script src="{{ asset('vue') }}/js/ajax-form.js"></script>
    <script src="{{ asset('vue') }}/js/wow.min.js"></script>
    <script src="{{ asset('vue') }}/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('vue') }}/js/jquery.final-countdown.min.js"></script>
    <script src="{{ asset('vue') }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('vue') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('vue') }}/js/plugins.js"></script>
    <script src="{{ asset('vue') }}/js/main.js"></script>

</body>

</html>