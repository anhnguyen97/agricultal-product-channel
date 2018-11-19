@extends('channel.layouts.master')


@section('header')
    @include('channel.layouts.header')
@endsection

@section('content')
<!-- Slide1 -->
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1 item1-slick1" style="background-image: url({{ asset('images/master-slide-1.jpg') }});">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
                        Be Stronger with our's product
                    </span>

                    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
                        New products
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                        <!-- Button -->
                        <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="item-slick1 item2-slick1" style="background-image: url(images/master-slide-2.jpg);">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
                        Be Stronger with our's product
                    </span>

                    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
                        New products
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
                        <!-- Button -->
                        <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="item-slick1 item3-slick1" style="background-image: url(images/master-slide-3.jpg);">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rotateInDownLeft">
                        Be Stronger with our's product
                    </span>

                    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rotateInUpRight">
                        New products
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
                        <!-- Button -->
                        <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- New Category -->
<section class="newproduct bgwhite p-t-45 p-b-105">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Category
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block3 -->
                    <div class="block3">
                        <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                            <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                        </a>

                        <div class="block3-txt p-t-14">
                            <h4 class="p-b-7">
                                <a href="blog-detail.html" class="m-text11">
                                    Black Friday Guide: Best Sales & Discount Codes
                                </a>
                            </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                            </a>

                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        Black Friday Guide: Best Sales & Discount Codes
                                    </a>
                                </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                            </a>

                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        Black Friday Guide: Best Sales & Discount Codes
                                    </a>
                                </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                            </a>

                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        Black Friday Guide: Best Sales & Discount Codes
                                    </a>
                                </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                            </a>

                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        Black Friday Guide: Best Sales & Discount Codes
                                    </a>
                                </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                            </a>

                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        Black Friday Guide: Best Sales & Discount Codes
                                    </a>
                                </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block3 -->
                        <div class="block3">
                            <a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
                                <img src="{{ asset('') }}/images/blog-01.jpg" alt="IMG-BLOG">
                            </a>

                            <div class="block3-txt p-t-14">
                                <h4 class="p-b-7">
                                    <a href="blog-detail.html" class="m-text11">
                                        Black Friday Guide: Best Sales & Discount Codes
                                    </a>
                                </h4>

                                {{-- <span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
                                <span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span> --}}

                                {{-- <p class="s-text8 p-t-16">
                                    Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
                                </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Product -->
    <section class="blog bgwhite p-t-94 p-b-65">
        <div class="container">
            <div class="sec-title p-b-52">
                <h3 class="m-text5 t-center">
                    Our Product
                </h3>
            </div>

            <div class="slick2">
                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                            <img src="{{ asset('') }}/images/item-02.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Herschel supply co 25l
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                $75.00
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ asset('') }}/images/item-03.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Denim jacket blue
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                $92.50
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ asset('') }}/images/item-05.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Coach slim easton black
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                $165.90
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                            <img src="{{ asset('') }}/images/item-07.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Frayed denim shorts
                            </a>

                            <span class="block2-oldprice m-text7 p-r-5">
                                $29.50
                            </span>

                            <span class="block2-newprice m-text8 p-r-5">
                                $15.90
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                            <img src="{{ asset('') }}/images/item-02.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Herschel supply co 25l
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                $75.00
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ asset('') }}/images/item-03.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Denim jacket blue
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                $92.50
                            </span>
                        </div>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ asset('') }}/images/item-05.jpg" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                Coach slim easton black
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                $165.90
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram -->
    <section class="instagram p-t-20">
        <div class="sec-title p-b-52 p-l-15 p-r-15">
            <h3 class="m-text5 t-center">
                @ follow the best farmers
            </h3>
        </div>

        <div class="flex-w">
            <!-- Block4 -->
            <div class="block4 wrap-pic-w">
                <img src="{{ asset('') }}/images/gallery-01.jpg" alt="IMG-INSTAGRAM">

                <a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
                    <span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
                        <i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
                        <span class="p-t-2">39</span>
                    </span>

                    <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
                        <p class="s-text10 m-b-15 h-size1 of-hidden">
                            Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
                        </p>

                        <span class="s-text9">
                            Farmer: @nancyward
                        </span>
                    </div>
                </a>
            </div>

            <!-- Block4 -->
            <div class="block4 wrap-pic-w">
                <img src="{{ asset('') }}/images/gallery-04.jpg" alt="IMG-INSTAGRAM">

                <a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
                    <span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
                        <i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
                        <span class="p-t-2">39</span>
                    </span>

                    <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
                        <p class="s-text10 m-b-15 h-size1 of-hidden">
                            Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
                        </p>

                        <span class="s-text9">
                            Farmer: @nancyward
                        </span>
                    </div>
                </a>
            </div>

            <!-- Block4 -->
            <div class="block4 wrap-pic-w">
                <img src="{{ asset('') }}/images/gallery-05.jpg" alt="IMG-INSTAGRAM">

                <a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
                    <span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
                        <i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
                        <span class="p-t-2">39</span>
                    </span>

                    <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
                        <p class="s-text10 m-b-15 h-size1 of-hidden">
                            Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
                        </p>

                        <span class="s-text9">
                            Farmer: @nancyward
                        </span>
                    </div>
                </a>
            </div>

            <!-- Block4 -->
            <div class="block4 wrap-pic-w">
                <img src="{{ asset('') }}/images/gallery-04.jpg" alt="IMG-INSTAGRAM">

                <a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
                    <span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
                        <i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
                        <span class="p-t-2">39</span>
                    </span>

                    <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
                        <p class="s-text10 m-b-15 h-size1 of-hidden">
                            Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
                        </p>

                        <span class="s-text9">
                            Farmer: @nancyward
                        </span>
                    </div>
                </a>
            </div>

            <!-- Block4 -->
            <div class="block4 wrap-pic-w">
                <img src="{{ asset('') }}/images/gallery-05.jpg" alt="IMG-INSTAGRAM">

                <a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
                    <span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
                        <i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
                        <span class="p-t-2">39</span>
                    </span>

                    <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
                        <p class="s-text10 m-b-15 h-size1 of-hidden">
                            Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
                        </p>

                        <span class="s-text9">
                            Farmer: @nancyward
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Shipping -->
    <section class="shipping bgwhite p-t-62 p-b-46">
        <div class="flex-w p-l-15 p-r-15">
            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                <h4 class="m-text12 t-center">
                    Free Delivery Worldwide
                </h4>

                <a href="#" class="s-text11 t-center">
                    Click here for more info
                </a>
            </div>

            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
                <h4 class="m-text12 t-center">
                    30 Days Return
                </h4>

                <span class="s-text11 t-center">
                    Simply return it within 30 days for an exchange.
                </span>
            </div>

            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                <h4 class="m-text12 t-center">
                    Store Opening
                </h4>

                <span class="s-text11 t-center">
                    Shop open from Monday to Sunday
                </span>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-90">
            <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    GET IN TOUCH
                </h4>

                <div>
                    <p class="s-text7 w-size27">
                        Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                    </p>

                    <div class="flex-m p-t-30">
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                    </div>
                </div>
            </div>

            {{-- <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4"> --}}
                <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                    <h4 class="s-text12 p-b-30">
                        Categories
                    </h4>

                    <ul>
                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Men
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                    <h4 class="s-text12 p-b-30">
                        Links
                    </h4>

                    <ul>
                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Search
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                About Us
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                    <h4 class="s-text12 p-b-30">
                        Newsletter
                    </h4>

                    <form>
                        <div class="effect1 w-size9">
                            <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                            <span class="effect1-line"></span>
                        </div>

                        <div class="w-size2 p-t-20">
                            <!-- Button -->
                            <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                                Subscribe
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="t-center p-l-15 p-r-15">
                <div class="t-center s-text8 p-t-20">
                    Copyright © 2018 All rights reserved. <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="" target="_blank">Project III - IT4421 - Soict</a>
                </div>
            </div>
        </footer>
        @endsection