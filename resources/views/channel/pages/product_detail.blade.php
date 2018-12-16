@extends('channel.layouts.master')
@section('css')
@include('channel.layouts.css') 
<link rel="stylesheet" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrapv4.0/css/bootstrap.min.css') }}">
@endsection

@section('navigation')
@include('channel.layouts.navigation')
@endsection

@section('content')
<div class="container single_product_container" style="padding-bottom: 0px">
    <div class="row">
        <div class="col">

            <!-- Breadcrumbs -->

            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="">Nông sản</a></li>
                    <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Chi tiết nông sản</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="single_product_pics">
                <div class="row">
                    <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                        <div class="single_product_thumbnails">
                            <ul>
                                <li><img src="{{ asset('') }}{{$product->thumbnail}}" alt="" data-image="images/single_1.jpg"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 image_col order-lg-2 order-1">
                        <div class="single_product_image">
                            <div class="single_product_image_background" style="background-image:url({{ asset('') }}{{$product->thumbnail}}); height: 400px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="product_details">
                <div class="product_details_title">
                    <h2>{{$product->name}}</h2>
                    <p></p>
                    <p class="text-justify">{{$product->description}}</p>
                </div>
                <div class="original_price">@if ($product->discount>0)
                    {{$product->price}} VNĐ
                @endif</div>
                <div class="product_price">{{$product->price*(100-$product->discount)/100 }} VNĐ</div>
                {{-- <ul class="star_rating">
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                </ul> --}}
                <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                    <span>Quantity:</span>
                    <div class="quantity_selector">
                        <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        <span id="quantity_value">10</span>{{$product->unit}}
                        <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                    </div>
                    <div class="red_button add_to_cart_button"><a class="btnAddCart" data-id="{{$product->id}}">add to cart</a></div>
                    {{-- <div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div> --}}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Tabs -->

<div class="tabs_section_container">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabs_container">
                    <ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                        <li class="tab active" data-active-tab="tab_1"><span>Nông dân</span></li>
                        <li class="tab" data-active-tab="tab_2"><span>Thông tin bổ sung</span></li>
                        <li class="tab" data-active-tab="tab_3"><span>Đánh giá</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">

                <!-- Tab Description -->
                <div id="tab_1" class="tab_container active">
                    <div class="row">
                        <div class="col-lg-10 desc_col">
                            <div class="tab_title">
                                <h4>Nông dân</h4>
                            </div>
                            <div class="tab_text_block">
                                <h4>{{$product->farmer->name}}</h4>
                                <p>Địa chỉ liên hệ: {{$product->farmer_contact->address}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab Additional Info -->

                <div id="tab_2" class="tab_container">
                    <div class="row">
                        <div class="col additional_info_col">
                            <div class="tab_title additional_info_title">
                                <h4>Thông tin bổ sung</h4>
                            </div>
                            <p>Ngày chế biến, nhập kho:<span>{{$product->created_at}}</span></p>
                            <p>Số lượng hiện còn:<span> {{$product->quantity}} {{$product->unit}}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Tab Reviews -->

                <div id="tab_3" class="tab_container">
                </div>

            </div>
        </div>
    </div>

</div>
@endsection


@section('js')
@include('channel.layouts.js')
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}" type="text/javascript" charset="utf-8" async defer></script>
<script src="{{ asset('shop/js/single_custom.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection