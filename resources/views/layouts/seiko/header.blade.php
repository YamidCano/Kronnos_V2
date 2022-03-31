<header class="page-header fullboxed variant-9 sticky always">
    <!-- Header Top Row -->
    <div class="header-top-row">
        <div class="container">
            <div class="header-top-left">
                <div class="header-custom-text">
                    <ul class="social-list-simple small">
                        <li>
                            <a href="#" class="icon icon-google google"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-twitter-logo twitter"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-facebook-logo facebook"></a>
                        </li>
                    </ul>
                </div>
                <div class="header-custom-text">
                    <span><i class="icon icon-phone"></i> +57 321 55 5555</span>
                    <span class="hidden-xs"><i class="icon icon-location"></i>
                        Acacias
                    </span>
                </div>
            </div>
            <div class="header-top-right">
                <!-- Header Links -->
                <div class="header-links">
                    <!-- Header Language -->
                    {{-- <div class="header-link header-select dropdown-link header-language">
                        <a href="#"><img src="{{ asset('seiko') }}/images/flags/eng.png" alt /></a>
                        <ul class="dropdown-container">
                            <li class="active">
                                <a href="#"><img src="{{ asset('seiko') }}/images/flags/eng.png" alt />English</a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('seiko') }}/images/flags/fr.png" alt />French</a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('seiko') }}/images/flags/den.png" alt />German</a>
                            </li>
                        </ul>
                    </div> --}}
                    <!-- /Header Language -->
                    <!-- Header Currency -->
                    {{-- <div class="header-link header-select dropdown-link header-currency">
                        <a href="#">USD</a>
                        <ul class="dropdown-container">
                            <li><a href="#"><span class="symbol">€</span>EUR</a></li>
                            <li class="active"><a href="#"><span
                                        class="symbol">$</span>USD</a></li>
                            <li><a href="#"><span class="symbol">£</span>GBP</a></li>
                        </ul>
                    </div> --}}
                    <!-- /Header Currency -->
                </div>
                <!-- /Header Links -->
            </div>
        </div>
    </div>
    <!-- /Header Top Row -->
    <div class="navbar">
        <div class="container">
            <!-- Menu Toggle -->
            <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
            <!-- /Menu Toggle -->
            <div class="header-right-links">
                <div class="collapsed-links-wrapper">
                    <div class="collapsed-links">
                        <!-- Header Links -->
                        <div class="header-links">
                            <!-- Header WishList -->
                            <div class="header-link">
                                <a href="#"><i class="icon icon-heart"></i><span class="badge">3</span><span
                                        class="link-text">Wishlist</span></a>
                            </div>
                            <!-- Header WishList -->
                            <!-- Header Account -->
                            @auth

                                <div class="header-link dropdown-link header-account">
                                    <a href="{{ url('/home') }}"><i class="icon icon-home"></i><span class="link-text">Dashboard</span></a>

                                </div>
                            @else
                                <div class="header-link dropdown-link header-account">
                                    <a href="#"><i class="icon icon-user"></i><span class="link-text">Login</span></a>
                                    <div class="dropdown-container right">
                                        <!-- form -->
                                        <form class="theme-form" method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <h4>Sign in to account</h4>
                                            <p>Enter your email & password to login</p>

                                            <div class="form-group">
                                                <input type="hidden" name="csrf-token" value="{!! csrf_token() !!}">
                                                <label class="col-form-label">Email Address</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="admin@kronnos.com{{ old('email') }}" required
                                                    autocomplete="off" autofocus>
                                                <span>
                                                    <strong>admin@kronnos.com</strong>
                                                </span>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Password</label>
                                                <div class="form-input position-relative">
                                                    <input id="password" type="password" value="123456"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password">
                                                    <span>
                                                        <strong>123456</strong>
                                                    </span>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                                @if (Route::has('password.request'))
                                                    <a class="link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                                <div class="text-end mt-3">
                                                    <button type="submit" class="btn btn-primary btn-block w-100">
                                                        {{ __('Login') }}
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2"
                                        href="sign-up.html">Create Account</a></p> --}}
                                        </form>
                                        <!-- /form -->
                                        <div class="title">OR</div>
                                        <div class="bottom-text">Create a <a href="/register">New
                                                Account</a></div>
                                    </div>
                                </div>
                            @endauth

                            <!-- /Header Account -->
                        </div>
                        <!-- /Header Links -->
                        <!-- Header Cart -->
                        <div class="header-link dropdown-link header-cart variant-1">
                            <a href="#"> <i class="icon icon-cart"></i> <span class="badge">3</span><span
                                    class="link-text">My
                                    Cart</span></a>
                            <!-- minicart wrapper -->
                            <div class="dropdown-container right">
                                <!-- minicart content -->
                                <div class="block block-minicart">
                                    <div class="minicart-content-wrapper">
                                        <div class="block-title">
                                            <span>Recently added item(s)</span>
                                        </div>
                                        <a class="btn-minicart-close" title="Close">&#10060;</a>
                                        <div class="block-content">
                                            <div class="minicart-items-wrapper overflowed">
                                                <ol class="minicart-items">
                                                    <li class="item product product-item">
                                                        <div class="product">
                                                            <a class="product-item-photo" href="#"
                                                                title="Long sleeve overall">
                                                                <span class="product-image-container">
                                                                    <span class="product-image-wrapper">
                                                                        <img class="product-image-photo"
                                                                            src="{{ asset('seiko') }}/images/products/product-16-c1.jpg"
                                                                            alt="Long sleeve overall">
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <div class="product-item-details">
                                                                <div class="product-item-name">
                                                                    <a href="#">Long sleeve overall</a>
                                                                </div>
                                                                <div class="product-item-qty">
                                                                    <label class="label">Qty</label>
                                                                    <input class="item-qty cart-item-qty" maxlength="12"
                                                                        value="1">
                                                                    <button class="update-cart-item"
                                                                        style="display: none" title="Update">
                                                                        <span>Update</span>
                                                                    </button>
                                                                </div>
                                                                <div class="product-item-pricing">
                                                                    <div class="price-container">
                                                                        <span class="price-wrapper">
                                                                            <span class="price-excluding-tax">
                                                                                <span class="minicart-price">
                                                                                    <span
                                                                                        class="price">$139.00</span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="product actions">
                                                                        <div class="secondary">
                                                                            <a href="#" class="action delete"
                                                                                title="Remove item">
                                                                                <span>Delete</span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="primary">
                                                                            <a class="action edit" href="#"
                                                                                title="Edit item">
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="item product product-item">
                                                        <div class="product">
                                                            <a class="product-item-photo" href="#"
                                                                title="Lace back mini dress">
                                                                <span class="product-image-container">
                                                                    <span class="product-image-wrapper">
                                                                        <img class="product-image-photo"
                                                                            src="{{ asset('seiko') }}/images/products/product-20.jpg"
                                                                            alt="Lace back mini dress">
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <div class="product-item-details">
                                                                <div class="product-item-name">
                                                                    <a href="#">Lace back mini dress</a>
                                                                </div>
                                                                <div class="product-item-qty">
                                                                    <label class="label">Qty</label>
                                                                    <input class="item-qty cart-item-qty" maxlength="12"
                                                                        value="1">
                                                                    <button class="update-cart-item"
                                                                        style="display: none" title="Update">
                                                                        <span>Update</span>
                                                                    </button>
                                                                </div>
                                                                <div class="product-item-pricing">
                                                                    <div class="price-container">
                                                                        <span class="price-wrapper">
                                                                            <span class="price-excluding-tax">
                                                                                <span class="minicart-price">
                                                                                    <span
                                                                                        class="price">$79.00</span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="product actions">
                                                                        <div class="secondary">
                                                                            <a href="#" class="action delete"
                                                                                title="Remove item">
                                                                                <span>Delete</span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="primary">
                                                                            <a class="action edit" href="#"
                                                                                title="Edit item">
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="item product product-item">
                                                        <div class="product">
                                                            <a class="product-item-photo" href="#"
                                                                title="Backless mini dress">
                                                                <span class="product-image-container">
                                                                    <span class="product-image-wrapper">
                                                                        <img class="product-image-photo"
                                                                            src="{{ asset('seiko') }}/images/products/product-7.jpg"
                                                                            alt="Backless mini dress">
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <div class="product-item-details">
                                                                <div class="product-item-name">
                                                                    <a href="#">Backless mini dress</a>
                                                                </div>
                                                                <div class="product-item-qty">
                                                                    <label class="label">Qty</label>
                                                                    <input class="item-qty cart-item-qty"
                                                                        maxlength="12" value="1">
                                                                    <button class="update-cart-item"
                                                                        style="display: none" title="Update">
                                                                        <span>Update</span>
                                                                    </button>
                                                                </div>
                                                                <div class="product-item-pricing">
                                                                    <div class="price-container">
                                                                        <span class="price-wrapper">
                                                                            <span class="price-excluding-tax">
                                                                                <span class="minicart-price">
                                                                                    <span
                                                                                        class="price">$369.00</span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="product actions">
                                                                        <div class="secondary">
                                                                            <a href="#" class="action delete"
                                                                                title="Remove item">
                                                                                <span>Delete</span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="primary">
                                                                            <a class="action edit" href="#"
                                                                                title="Edit item">
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                            <div class="subtotal">
                                                <span class="label">
                                                    <span>Subtotal</span>
                                                </span>
                                                <div class="amount price-container">
                                                    <span class="price-wrapper"><span
                                                            class="price">$587.00</span></span>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="secondary">
                                                    <a href="#" class="btn btn-alt">
                                                        <i class="icon icon-cart"></i><span>View and edit
                                                            cart</span>
                                                    </a>
                                                </div>
                                                <div class="primary">
                                                    <a class="btn" href="#">
                                                        <i class="icon icon-external-link"></i><span>Go to
                                                            Checkout</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /minicart content -->
                            </div>
                            <!-- /minicart wrapper -->
                        </div>
                        <!-- /Header Cart -->
                    </div>
                </div>
                <!-- Header Search -->
                <div class="header-link header-search header-search">
                    <div class="exp-search">
                        <form>
                            <input class="exp-search-input " placeholder="Search here ..." type="text" value="">
                            <input class="exp-search-submit" type="submit" value="">
                            <span class="exp-icon-search"><i class="icon icon-magnify"></i></span>
                            <span class="exp-search-close"><i class="icon icon-close"></i></span>
                        </form>
                    </div>
                </div>
                <!-- /Header Search -->
            </div>
            <!-- Logo -->
            <div class="header-logo">
                <a href="index.html" title="Logo"><img src="../assets/images/logo/login.png" alt="Logo" /></a>
            </div>
            <!-- /Logo -->
            <!-- Mobile Menu -->
            <div class="mobilemenu dblclick">
                <div class="mobilemenu-header">
                    <div class="title">MENU</div>
                    <a href="#" class="mobilemenu-toggle"></a>
                </div>
                <div class="mobilemenu-content">
                    <ul class="nav">
                        <li><a href="{{ route('ecommerce') }}">HOME</a><span class="arrow"></span>
                            {{-- <ul>
                                <li> <a href="index.html" title="">Default</a> </li>
                                <li> <a href="index-bg-white.html" title="">White Background</a> </li>
                                <li> <a href="index-layout-6.html" title="">Wide + Side Panel</a> </li>
                                <li> <a href="index-layout-1.html" title="">Classic</a> </li>
                                <li> <a href="index-layout-2.html" title="">Journal<span
                                            class="menu-label">new look</span></a> </li>
                                <li> <a href="index-layout-3.html" title="">Banners Boom</a> </li>
                                <li> <a href="index-fullscreen-slider.html" title="">Fullscreen Slider</a>
                                </li>
                                <li> <a href="index-layout-4.html" title="">Amason</a> </li>
                                <li> <a href="index-layout-5.html" title="">Lookbook</a> </li>
                                <li> <a href="index-rtl.html" title="">RTL</a> </li>
                                <li> <a href="index-popup.html" title="">Popup on Load</a> </li>
                            </ul> --}}
                        </li>
                        <li>
                            <a href="#" title="">Pages</a><span class="arrow"></span>
                            <ul>
                                <li>
                                    <a href="category.html" title="">Listing<span class="menu-label-alt">NEW
                                            FEATURES</span></a><span class="arrow"></span>
                                    <ul>
                                        <li><a href="category.html" title="">Classic Listing</a>
                                        </li>
                                        <li><a href="category-fixed-sidebar.html" title="">Listing Fixed
                                                Filter<span class="menu-label-alt">NEW </span></a>
                                        </li>
                                        <li><a href="category-no-filter.html" title="">Listing No Filter</a>
                                        </li>
                                        <li><a href="category-empty.html" title="">Empty Category</a></li>
                                        <li><a href="category.html" title="">Products per row</a><span
                                                class="arrow"></span>
                                            <ul>
                                                <li> <a href="category-2-per-row.html" title="">2 per
                                                        row</a></li>
                                                <li> <a href="category-3-per-row.html" title="">3 per
                                                        row</a></li>
                                                <li> <a href="category-4-per-row.html" title="">4 per
                                                        row</a></li>
                                                <li> <a href="category-5-per-row.html" title="">5 per
                                                        row</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="product.html" title="">Product</a><span class="arrow"></span>
                                    <ul>
                                        <li> <a href="product.html" title="">Classic design</a><span
                                                class="arrow"></span>
                                            <ul>
                                                <li> <a href="product-image-small.html" title="">Image
                                                        small</a></li>
                                                <li> <a href="product-image-medium.html" title="">Image
                                                        medium</a></li>
                                                <li> <a href="product-image-medium-plus.html" title="">Image
                                                        medium plus</a></li>
                                                <li> <a href="product-image-large.html" title="">Image
                                                        large</a></li>
                                            </ul>
                                        </li>
                                        <li> <a href="product-creative.html" title="">Creative design</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="index.html" title="">Headers</a><span class="arrow"></span>
                                    <ul>
                                        <li> <a href="header-variant-1.html" title="">Header 1 (one row
                                                shift)</a> </li>
                                        <li> <a href="header-variant-2.html" title="">Header 2 (one row)</a>
                                        </li>
                                        <li> <a href="header-variant-3.html" title="">Header 3 (one row
                                                dark)</a> </li>
                                        <li> <a href="header-variant-4.html" title="">Header 4 (three
                                                rows)</a> </li>
                                        <li> <a href="header-variant-5.html" title="">Header 5 (two
                                                rows)</a> </li>
                                        <li> <a href="header-variant-6.html" title="">Header 6 (two rows
                                                center)</a> </li>
                                        <li> <a href="header-variant-7.html" title="">Header 7 (three
                                                row)</a> </li>
                                        <li> <a href="header-variant-8.html" title="">Header 8
                                                (department)</a> </li>
                                        <li> <a href="header-variant-9.html" title="">Header 9
                                                (creative)</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="index.html" title="">Footers</a><span class="arrow"></span>
                                    <ul>
                                        <li> <a href="footer-variant-1.html" title="">Footer 1 (simple)</a>
                                        </li>
                                        <li> <a href="footer-variant-2.html" title="">Footer 2 (links)</a>
                                        </li>
                                        <li> <a href="footer-variant-3.html" title="">Footer 3 (menu)</a>
                                        </li>
                                        <li> <a href="footer-variant-4.html" title="">Footer 4
                                                (advanced)</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="gallery.html" title="">Gallery</a><span class="arrow"></span>
                                    <ul>
                                        <li> <a href="gallery.html" title="">Gallery 2 in row</a> </li>
                                        <li> <a href="gallery-3-per-row.html" title="">Gallery 3 in row</a>
                                        </li>
                                        <li> <a href="gallery-simple.html" title="">No isotope Gallery</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="blog.html" title="">Blog</a>
                                    <ul>
                                        <li> <a href="blog.html" title="">List+Sidebar</a> </li>
                                        <li> <a href="blog-grid-2.html" title="">Grid 2</a> </li>
                                        <li> <a href="blog-grid-3.html" title="">Grid 3</a> </li>
                                        <li> <a href="blog-grid-4.html" title="">Grid 4</a> </li>
                                        <li> <a href="blog-single.html" title="">Single Post</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" title="">Pages</a><span class="arrow"></span>
                                    <ul>
                                        <li> <a href="faq.html" title="">Faq</a> </li>
                                        <li> <a href="about.html" title="">About Us</a> </li>
                                        <li> <a href="contact.html" title="">Contact Us</a> </li>
                                        <li> <a href="404.html" title="">404</a> </li>
                                        <li> <a href="typography.html" title="">Typography</a> </li>
                                        <li> <a href="coming-soon.html" title="">Coming soon</a> </li>
                                        <li> <a href="login.html" title="">Login</a> </li>
                                        <li> <a href="account-create.html" title="">Account</a> </li>
                                        <li> <a href="cart.html" title="">Cart</a> </li>
                                        <li> <a href="cart-empty.html" title="">Empty Cart</a> </li>
                                        <li> <a href="wishlist.html" title="">Wishlist</a> </li>
                                    </ul>
                                </li>
                                <li> <a href="http://seiko-shopify.big-skins.com/banners-grid-online-editor/"
                                        title="">Banners / Grid Editor<span class="menu-label-alt">EXCLUSIVE</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="category.html">Men</a></li>
                        <li><a href="category.html">Women</a></li>
                        <li><a href="category.html">Electronics</a></li>
                    </ul>
                </div>
            </div>
            <!-- Mobile Menu -->
            <!-- Mega Menu -->
            <div class="megamenu fadein blackout">
                <ul class="nav">
                    <li class="simple-dropdown">
                        <a href="{{ route('ecommerce') }}">HOME</a>
                        {{-- <div class="sub-menu">
                            <ul class="category-links">
                                <li> <a href="index.html" title="">Default</a> </li>
                                <li> <a href="index-bg-white.html" title="">White Background</a> </li>
                                <li> <a href="index-layout-6.html" title="">Wide + Side Panel</a> </li>
                                <li> <a href="index-layout-1.html" title="">Classic</a> </li>
                                <li> <a href="index-layout-2.html" title="">Journal<span
                                            class="menu-label">new look</span></a> </li>
                                <li> <a href="index-layout-3.html" title="">Banners Boom</a> </li>
                                <li> <a href="index-fullscreen-slider.html" title="">Fullscreen Slider</a>
                                </li>
                                <li> <a href="index-layout-4.html" title="">Amason</a> </li>
                                <li> <a href="index-layout-5.html" title="">Lookbook</a> </li>
                                <li> <a href="index-rtl.html" title="">RTL</a> </li>
                                <li> <a href="index-popup.html" title="">Popup on Load</a> </li>
                            </ul>
                        </div> --}}
                    </li>
                    {{-- <li class="simple-dropdown">
                        <a href="#" title="">Pages</a>
                        <div class="sub-menu">
                            <ul class="category-links">
                                <li>
                                    <a href="category.html" title="">Listing<span
                                            class="menu-label-alt">NEW FEATURES</span></a><span
                                        class="arrow"></span>
                                    <ul>
                                        <li><a href="category.html" title="">Classic Listing</a>
                                        </li>
                                        <li><a href="category-fixed-sidebar.html" title="">Listing Fixed
                                                Filter<span class="menu-label-alt">NEW </span></a>
                                        </li>
                                        <li><a href="category-no-filter.html" title="">Listing No Filter</a>
                                        </li>
                                        <li><a href="category-empty.html" title="">Empty Category</a></li>
                                        <li><a href="category.html" title="">Products per row</a><span
                                                class="arrow"></span>
                                            <ul>
                                                <li> <a href="category-2-per-row.html" title="">2 per
                                                        row</a></li>
                                                <li> <a href="category-3-per-row.html" title="">3 per
                                                        row</a></li>
                                                <li> <a href="category-4-per-row.html" title="">4 per
                                                        row</a></li>
                                                <li> <a href="category-5-per-row.html" title="">5 per
                                                        row</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="product.html" title="">Product</a>
                                    <ul>
                                        <li> <a href="product.html" title="">Classic design</a><span
                                                class="arrow"></span>
                                            <ul>
                                                <li> <a href="product-image-small.html" title="">Image
                                                        small</a></li>
                                                <li> <a href="product-image-medium.html" title="">Image
                                                        medium</a></li>
                                                <li> <a href="product-image-medium-plus.html" title="">Image
                                                        medium plus</a></li>
                                                <li> <a href="product-image-large.html" title="">Image
                                                        large</a></li>
                                            </ul>
                                        </li>
                                        <li> <a href="product-creative.html" title="">Creative design</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="index.html" title="">Headers</a>
                                    <ul>
                                        <li> <a href="header-variant-1.html" title="">Header 1 (one row
                                                shift)</a> </li>
                                        <li> <a href="header-variant-2.html" title="">Header 2 (one row)</a>
                                        </li>
                                        <li> <a href="header-variant-3.html" title="">Header 3 (one row
                                                dark)</a> </li>
                                        <li> <a href="header-variant-4.html" title="">Header 4 (three
                                                rows)</a> </li>
                                        <li> <a href="header-variant-5.html" title="">Header 5 (two
                                                rows)</a> </li>
                                        <li> <a href="header-variant-6.html" title="">Header 6 (two rows
                                                center)</a> </li>
                                        <li> <a href="header-variant-7.html" title="">Header 7 (three
                                                row)</a> </li>
                                        <li> <a href="header-variant-8.html" title="">Header 8
                                                (department)</a> </li>
                                        <li> <a href="header-variant-9.html" title="">Header 9
                                                (creative)</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="index.html" title="">Footers</a>
                                    <ul>
                                        <li> <a href="footer-variant-1.html" title="">Footer 1 (simple)</a>
                                        </li>
                                        <li> <a href="footer-variant-2.html" title="">Footer 2 (links)</a>
                                        </li>
                                        <li> <a href="footer-variant-3.html" title="">Footer 3 (menu)</a>
                                        </li>
                                        <li> <a href="footer-variant-4.html" title="">Footer 4
                                                (advanced)</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="gallery.html" title="">Gallery</a>
                                    <ul>
                                        <li> <a href="gallery.html" title="">Gallery 2 in row</a> </li>
                                        <li> <a href="gallery-3-per-row.html" title="">Gallery 3 in row</a>
                                        </li>
                                        <li> <a href="gallery-simple.html" title="">No isotope Gallery</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="blog.html" title="">Blog</a>
                                    <ul>
                                        <li> <a href="blog.html" title="">List+Sidebar</a> </li>
                                        <li> <a href="blog-grid-2.html" title="">Grid 2</a> </li>
                                        <li> <a href="blog-grid-3.html" title="">Grid 3</a> </li>
                                        <li> <a href="blog-grid-4.html" title="">Grid 4</a> </li>
                                        <li> <a href="blog-single.html" title="">Single Post</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" title="">Pages</a>
                                    <ul>
                                        <li> <a href="faq.html" title="">Faq</a> </li>
                                        <li> <a href="about.html" title="">About Us</a> </li>
                                        <li> <a href="contact.html" title="">Contact Us</a> </li>
                                        <li> <a href="404.html" title="">404</a> </li>
                                        <li> <a href="typography.html" title="">Typography</a> </li>
                                        <li> <a href="coming-soon.html" title="">Coming soon</a> </li>
                                        <li> <a href="login.html" title="">Login</a> </li>
                                        <li> <a href="account-create.html" title="">Account</a> </li>
                                    </ul>
                                </li>
                                <li> <a href="http://seiko-shopify.big-skins.com/banners-grid-online-editor/"
                                        title="">Banners / Grid Editor<span
                                            class="menu-label-alt">EXCLUSIVE</span></a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="mega-dropdown">
                        <a href="category.html">Men<span class="menu-label">-15%</span></a>
                        <div class="sub-menu">
                            <div class="container">
                                <div class="megamenu-categories column-4">
                                    <!-- megamenu column -->
                                    <div class="col">
                                        <a class="category-image" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-03.jpg" alt /></a>
                                        <div class="category-title"><a href="#">Only New</a></div>
                                        <ul class="category-links">
                                            <li><a href="#">New In Clothing</a></li>
                                            <li><a href="#">New In Shoes</a></li>
                                            <li><a href="#">New In Accessories</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column -->
                                    <!-- megamenu column -->
                                    <div class="col">
                                        <a class="category-image" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-04.jpg" alt /></a>
                                        <div class="category-title"><a href="#">Only Sale</a></div>
                                        <ul class="category-links">
                                            <li><a href="#">Sale Clothing</a></li>
                                            <li><a href="#"><b>Sale Shoes</b><span
                                                        class="menu-label">THREE DAYS ONLY!</span></a>
                                            </li>
                                            <li><a href="#">Sale Accessories</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column -->
                                    <!-- megamenu column -->
                                    <div class="col">
                                        <a class="category-image" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-05.jpg" alt /></a>
                                        <div class="category-title"><a href="#">Top</a><span
                                                class="menu-label-alt">NEW</span></div>
                                        <ul class="category-links">
                                            <li><a href="#">T-Shirts & Vests</a></li>
                                            <li><a href="#">Jumpers & Cardigans</a></li>
                                            <li><a href="#">Coats & Jackets</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column -->
                                    <!-- megamenu column -->
                                    <div class="col">
                                        <a class="category-image" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-06.jpg" alt /></a>
                                        <div class="category-title"><a href="#">Bottom</a></div>
                                        <ul class="category-links">
                                            <li><a href="#">Shorts</a></li>
                                            <li><a href="#">Pants</a></li>
                                            <li><a href="#">Denim</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column -->
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-dropdown">
                        <a href="category.html">Women<span class="menu-label-alt">NEW</span></a>
                        <div class="sub-menu">
                            <div class="container">
                                <div class="megamenu-right width-25">
                                    <div class="banner style-1 autosize-text" data-fontratio="4.2">
                                        <img src="{{ asset('seiko') }}/images/banners/banner-1.jpg" alt="Banner">
                                        <div class="banner-caption vertb">
                                            <div class="vert-wrapper">
                                                <div class="vert">
                                                    <div class="text-1">WOMEN 2016</div>
                                                    <div class="text-2">collections sale</div>
                                                    <div class="text-3"> SAVE UP TO 40% OF</div>
                                                    <a href="#buttonlink" class="banner-btn-wrap">
                                                        <div class="banner-btn text-hoverslide"
                                                            data-hcolor="#f82e56"><span><span
                                                                    class="text">SHOP
                                                                    NOW</span><span
                                                                    class="hoverbg"></span></span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="megamenu-categories column-2">
                                    <!-- megamenu column 1 -->
                                    <div class="col">
                                        <a class="category-image" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-01.jpg" alt /></a>
                                        <div class="category-title title-border"><a
                                                href="#">ACCESSORIES<span
                                                    class="menu-label">HOT</span></a></div>
                                        <ul class="category-links column-count-2">
                                            <li><a href="#">New In</a></li>
                                            <li><a href="#">Belt Buckles</a></li>
                                            <li><a href="#">Collar Tips</a></li>
                                            <li><a href="#">Fascinators & Headpieces<span
                                                        class="menu-label">HOT PRICE</span></a></li>
                                            <li><a href="#">Gloves & Mittens</a></li>
                                            <li><a href="#">Hair Accessories</a></li>
                                            <li><a href="#">Handkerchiefs</a></li>
                                            <li><a href="#">ID & Document Holders</a></li>
                                            <li><a href="#">T-Shirts & Vests</a></li>
                                            <li><a href="#">Rings & Finders</a></li>
                                            <li><a href="#">Day Planners</a></li>
                                            <li><a href="#">Scarves & Wraps</a></li>
                                            <li><a href="#">Wallets</a></li>
                                            <li><a href="#">Umbrellas</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column 1 -->
                                    <!-- megamenu column 2 -->
                                    <div class="col">
                                        <a class="category-image" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-02.jpg" alt /></a>
                                        <div class="category-title title-border"><a href="#">CLOTHING<span
                                                    class="menu-label-alt">NEW</span></a></div>
                                        <ul class="category-links column-count-2">
                                            <li><a href="#">New In</a></li>
                                            <li><a href="#">T-Shirts & Vests</a></li>
                                            <li><a href="#">Jumpers & Cardigans</a></li>
                                            <li><a href="#">Hoodies & Sweats<span
                                                        class="menu-label">-15%</span></a></li>
                                            <li><a href="#">Coats & Jackets</a></li>
                                            <li><a href="#">Joggers & Tracksuits</a></li>
                                            <li><a href="#">Shorts</a></li>
                                            <li><a href="#">Athletic Apparel</a></li>
                                            <li><a href="#">Intimates & Sleep</a></li>
                                            <li><a href="#">Outerwear</a></li>
                                            <li><a href="#">Swimwear</a></li>
                                            <li><a href="#">Denim Collection</a></li>
                                            <li><a href="#">Tops & Blouses</a></li>
                                            <li><a href="#">Shorts</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column 2 -->
                                    <!-- megamenu bottom -->
                                    <div class="megamenu-bottom">
                                        <a href="#"><img class="img-responsive"
                                                src="{{ asset('seiko') }}/images/banners/banner-megamenu.jpg"
                                                alt="megamenu banner"></a>
                                    </div>
                                    <!-- /megamenu bottom -->
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-dropdown">
                        <a href="category.html">Electronics</a>
                        <div class="sub-menu">
                            <div class="container">
                                <div class="megamenu-left width-33">
                                    <a href="#bannerLink" class="banner-wrap">
                                        <div class="banner style-13 autosize-text image-hover-scale"
                                            data-fontratio="4">
                                            <img src="{{ asset('seiko') }}/images/banners/banner-21.jpg" alt="Banner">
                                            <div class="banner-caption horc vertb" style="bottom: 3%;">
                                                <div class="vert-wrapper">
                                                    <div class="vert">
                                                        <div class="text-1">NEW STYLE</div>
                                                        <div class="text-2">New Collection</div>
                                                        <div class="banner-btn text-hoverslide"
                                                            data-hcolor="#f82e56"><span><span
                                                                    class="text">SHOP
                                                                    NOW</span><span
                                                                    class="hoverbg"></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="megamenu-categories column-3">
                                    <!-- megamenu column 1 -->
                                    <div class="col">
                                        <a class="category-image light" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-07.jpg" alt /></a>
                                        <div class="category-title title-border"><a href="#">Cameras &
                                                Camcorders<span class="menu-label">HOT</span></a></div>
                                        <ul class="category-links">
                                            <li><a href="#">New In</a></li>
                                            <li><a href="#">All Cameras</a></li>
                                            <li><a href="#">All Camcorders</a></li>
                                            <li><a href="#">Camera Accessories</a></li>
                                            <li><a href="#">Camera Lenses</a></li>
                                            <li><a href="#">Memory Cards</a></li>
                                            <li><a href="#">Web Cameras</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column 1 -->
                                    <!-- megamenu column 2 -->
                                    <div class="col">
                                        <a class="category-image light" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-09.jpg" alt /></a>
                                        <div class="category-title title-border"><a href="#">Cell
                                                Phones<span class="menu-label-alt">NEW</span></a></div>
                                        <ul class="category-links">
                                            <li><a href="#">No-Contract Phones & Plans</a></li>
                                            <li><a href="#">Accessories</a></li>
                                            <li><a href="#">Apple iPhone</a></li>
                                            <li><a href="#">Mobile Hotspots & Plans<span
                                                        class="menu-label">-15%</span></a></li>
                                            <li><a href="#">Samsung Galaxy</a></li>
                                            <li><a href="#">Prepaid Cell Phones</a></li>
                                            <li><a href="#">SIM Cards</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column 2 -->
                                    <!-- megamenu column 3 -->
                                    <div class="col">
                                        <a class="category-image light" href="#"><img
                                                src="{{ asset('seiko') }}/images/category/megamenu-category-08.jpg" alt /></a>
                                        <div class="category-title title-border"><a href="#">Video
                                                Games<span class="menu-label">HOT</span></a></div>
                                        <ul class="category-links">
                                            <li><a href="#">PlayStation 4</a></li>
                                            <li><a href="#">Xbox One</a></li>
                                            <li><a href="#">Nintendo 3DS / 2DS</a></li>
                                            <li><a href="#">Video Game Accessories></a></li>
                                            <li><a href="#">Xbox Live Cards</a></li>
                                            <li><a href="#">Strategy Guides</a></li>
                                            <li><a href="#"><i class="icon icon-gift"></i> Gaming Gift
                                                    Cards</a></li>
                                        </ul>
                                    </div>
                                    <!-- /megamenu column 3 -->
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    <li><a href="category.html">Sale</a></li>
                </ul>
            </div>
            <!-- /Mega Menu -->
        </div>
    </div>
</header>
