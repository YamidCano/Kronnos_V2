<div>

    <main class="page-main">
        <div class="block fullwidth full-nopad bottom-space">
            <div class="container">
                <!-- Main Slider -->
                <div class="mainSlider" data-thumb="true" data-thumb-width="230" data-thumb-height="100">
                    <div class="sliderLoader">Loading...</div>
                    <!-- Slider main container -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @if ($slider->count())
                                @foreach ($slider as $item)
                                    <div class="swiper-slide" data-thumb="{{ Storage::url($item->sliderphoto) }}"
                                        data-href="#" data-target="_blank">
                                        <!-- _blank or _self ( _self is default )-->
                                        <div class="wrapper">
                                            <figure>
                                                <img src="{{ Storage::url($item->sliderphoto) }}" alt="" width="1815"
                                                    height="710">
                                            </figure>
                                            <div class="text2-1 animate" data-animate="flipInY" data-delay="0">
                                                {{ $item->name }}
                                            </div>
                                            {{-- <div class="text2-2 animate" data-animate="bounceIn" data-delay="500">
                                                Season sale </div>
                                            <div class="text2-3 animate" data-animate="bounceIn" data-delay="1000">
                                                popular brands </div>
                                            <div class="text2-4 animate" data-animate="rubberBand" data-delay="1500">
                                                70% </div>
                                            <div class="text2-5 animate" data-animate="hinge" data-delay="2000"> OFF
                                            </div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide"
                                    data-thumb="{{ asset('seiko') }}/images/slider/slide-02.jpg"
                                    data-href="#" data-target="_blank">
                                    <!-- _blank or _self ( _self is default )-->
                                    <div class="wrapper">
                                        <figure>
                                            <img src="{{ asset('seiko') }}/images/slider/slide-02.jpg" alt=""
                                                width="1815" height="710">
                                        </figure>
                                        <div class="text2-1 animate" data-animate="flipInY" data-delay="0">
                                            Kronnos
                                        </div>
                                        {{-- <div class="text2-2 animate" data-animate="bounceIn" data-delay="500">
                                        Season sale </div>
                                    <div class="text2-3 animate" data-animate="bounceIn" data-delay="1000">
                                        popular brands </div>
                                    <div class="text2-4 animate" data-animate="rubberBand" data-delay="1500">
                                        70% </div>
                                    <div class="text2-5 animate" data-animate="hinge" data-delay="2000"> OFF
                                    </div> --}}
                                    </div>
                                </div>
                            @endif

                        </div>
                        <!-- pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- pagination thumbs -->
                        <div class="swiper-pagination-thumbs">
                            <div class="thumbs-wrapper">
                                <div class="thumbs"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Main Slider -->
            </div>
        </div>
        <div class="block">
            <div class="container">
                <!-- Wellcome text -->
                <div class="text-center bottom-space">
                    <h1 class="size-lg no-padding">BIENVENIDO A <span class="logo-font custom-color">KRONNOS</span>
                        TIENDA</h1>
                    <div class="line-divider"></div>
                    <p class="custom-color-alt">Lorem ipsum dolor sit amet, ex eam mundi populo accusamus,
                        aliquam quaestio petentium te cum.
                        <br> Vim ei oblique tacimates, usu cu iudico graeco. Graeci eripuit inimicus vel eu, eu
                        mel unum laoreet splendide, cu integre apeirian has.
                    </p>
                </div>
                <!-- /Wellcome text -->
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="box style2 bgcolor1 text-center">
                            <div class="box-icon"><i class="icon icon-truck"></i></div>
                            <h3 class="box-title">ENVÍO GRATIS</h3>
                            <div class="box-text">Envío gratis superiores a $200.000</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box style2 bgcolor2 text-center">
                            <div class="box-icon"><i class="icon icon-dollar"></i></div>
                            <h3 class="box-title">DEVOLUCIÓN DE DINERO</h3>
                            <div class="box-text">100% garantía de devolución de dinero</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box style2 bgcolor3 text-center">
                            <div class="box-icon"><i class="icon icon-help"></i></div>
                            <h3 class="box-title">SOPORTE EN LÍNEA</h3>
                            <div class="box-text">Soporte de servicio rápido 24/7</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <ul class="filters filters-product style2">
                    <li><a href="#" class="filter-label">All<span class="count"></span></a></li>
                    <li><a href="#" class="filter-label active" data-filter=".category1">New<span
                                class="count"></span></a></li>
                    <li><a href="#" class="filter-label" data-filter=".category2">Sale<span
                                class="count"></span></a></li>
                </ul>
                <div class="products-grid-wrapper isotope-wrapper">
                    <div class="products-grid isotope four-in-row product-variant-4">
                        <!-- Product Item -->
                        @if ($product->count())
                            @foreach ($product as $item)
                                <div class="product-item large category1">
                                    <div class="product-item-inside">
                                        <div class="product-item-info">
                                            <!-- Product Photo -->
                                            <div class="product-item-photo">
                                                <!-- Product Label -->
                                                @if ($item->new == 1)
                                                    <div class="product-item-label label-new"><span>New</span></div>
                                                @endif

                                                @if (!empty($item->sales))
                                                    <div class="product-item-label label-sale">
                                                        <span>-{{ $item->sales }}%</span>
                                                    </div>
                                                @endif
                                                <!-- /Product Label -->
                                                <div class="product-item-gallery">
                                                    <!-- product main photo -->
                                                    <div class="product-item-gallery-main">
                                                        <a href="#"><img class="product-image-photo"
                                                                src="{{ Storage::url($item->photo) }}" alt=""
                                                                width="280" height="380"></a>
                                                        <a href="quick-view.html" title="Quick View"
                                                            class="quick-view-link quick-view-btn"> <i
                                                                class="icon icon-eye"></i><span>Quick View</span></a>
                                                    </div>
                                                    <!-- /product main photo  -->
                                                </div>
                                                <!-- Product Actions -->
                                                <a href="#" title="Add to Wishlist" class="no_wishlist">
                                                    {{-- <i class="icon icon-heart"></i> --}}
                                                    <span>Add to Wishlist</span>
                                                </a>
                                                {{-- <div class="product-item-actions">
                                                    <div class="share-button toBottom">
                                                        <span class="toggle"></span>
                                                    </div>
                                                </div> --}}
                                                <!-- /Product Actions -->
                                            </div>
                                            <!-- /Product Photo -->
                                            <!-- Product Details -->
                                            <div class="product-item-details">
                                                <div class="product-item-name"> <a
                                                        title="Longline  asymmetric midi skirt" href="product.html"
                                                        class="product-item-link">
                                                        {{ $item->name }}
                                                    </a>
                                                </div>
                                                <div class="product-item-description">Neque porro quisquam est, qui
                                                    dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                                    quia nonkdni numquam eius modi tempora incidunt ut labore</div>
                                                @if (!empty($item->sales))
                                                    <div class="price-box">
                                                        <span class="price-container">
                                                            <span class="price-wrapper">
                                                                <span class="old-price">
                                                                    $ {{ $item->price }}
                                                                </span>
                                                                <span class="special-price">
                                                                    <?php
                                                                    $descuento = $item->price - ($item->price * $item->sales) / 100;
                                                                    ?>
                                                                    $ {{ $descuento }}.00
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="price-box"> <span class="price-container"> <span
                                                                class="price-wrapper">
                                                                <span class="special-price">
                                                                    ${{ $item->price }}
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                @endif

                                                <button class="btn add-to-cart" data-product="789123"> <i
                                                        class="icon icon-cart"></i>
                                                    <span>
                                                        Add to Cart
                                                    </span>
                                                </button>
                                            </div>
                                            <!-- /Product Details -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="product-item large category1">
                                <div class="product-item-inside">
                                    <div class="product-item-info">
                                        <!-- Product Photo -->
                                        <div class="product-item-photo">
                                            <!-- Product Label -->
                                            <div class="product-item-label label-new"><span>New</span></div>
                                            <div class="product-item-label label-sale"><span>-50%</span></div>
                                            <!-- /Product Label -->
                                            <div class="product-item-gallery">
                                                <!-- product main photo -->
                                                <div class="product-item-gallery-main box">
                                                    <a href="#"><img class="product-image-photo"
                                                            src="{{ asset('seiko') }}/images/products/product-10.jpg"
                                                            alt=""></a>
                                                    <a href="#" title="Quick View"
                                                        class="quick-view-link quick-view-btn"> <i
                                                            class="icon icon-eye"></i><span>Quick View</span></a>
                                                </div>
                                                <!-- /product main photo  -->
                                            </div>
                                            <!-- Product Actions -->
                                            <a href="#" title="Add to Wishlist" class="no_wishlist"> <i
                                                    class="icon icon-heart"></i><span>Add to Wishlist</span> </a>
                                            {{-- <div class="product-item-actions">
                                                <div class="share-button toBottom">
                                                    <span class="toggle"></span>
                                                </div>
                                            </div> --}}
                                            <!-- /Product Actions -->
                                        </div>
                                        <!-- /Product Photo -->
                                        <!-- Product Details -->
                                        <div class="product-item-details">
                                            <div class="product-item-name"> <a title="Longline  asymmetric midi skirt"
                                                    href="#" class="product-item-link">Longline asymmetric
                                                    midi
                                                    skirt</a>
                                            </div>
                                            <div class="product-item-description">Neque porro quisquam est, qui
                                                dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                                quia nonkdni numquam eius modi tempora incidunt ut labore</div>
                                            <div class="price-box"> <span class="price-container"> <span
                                                        class="price-wrapper"> <span
                                                            class="old-price">$290.00</span>
                                                        <span class="special-price">$229.00</span> </span>
                                                </span>
                                            </div>
                                            <button class="btn add-to-cart" disabled data-product="789123">
                                                {{-- <i class="icon icon-cart"></i> --}}
                                                <span>Add to Cart</span>
                                            </button>
                                        </div>
                                        <!-- /Product Details -->
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- /Product Item -->
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
