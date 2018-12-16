@extends('channel.layouts.master')
@section('css')
@include('channel.layouts.css') 
<link rel="stylesheet" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/categories_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/categories_responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrapv4.0/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@if (Auth::check())
<style type="text/css" media="screen">
.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
  display: flex;
}

.carousel-inner .carousel-item-right.active,
.carousel-inner .carousel-item-next {
  transform: translateX(25%);
}

.carousel-inner .carousel-item-left.active, 
.carousel-inner .carousel-item-prev {
  transform: translateX(-25%);
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left{ 
  transform: translateX(0); 
}
</style>
@endif


@endsection

@section('navigation')
@include('channel.layouts.navigation')
@endsection
@if (!Auth::check())
@section('slider')
<div id="carouselExampleIndicators" class="carousel slide main_slider" data-ride="carousel" style="height: 650px; margin-top: 0px">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('') }}storage/sliders/cafe.jpg" alt="First slide">
            <div class="carousel-caption">
                <h5>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h5>
                <button type="">Register now</button>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('') }}storage/sliders/Fotolia_67389725_Subscription_Monthly_XXL.jpg" alt="Second slide">
            <div class="carousel-caption">
                <h5>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h5>
                <a href="" class="btn btn-info" title="">Join with us</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('') }}storage/sliders/hinh-nen-trai-cay-cu-qua.jpg" alt="Third slide">
            <div class="carousel-caption">
                <h5>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h5>
                <a href="" class="btn btn-info" title="">Join with us</a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="margin-top: 100px">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="font-weight: 50px"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="margin-top: 100px">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endsection

@else

@section('content')
@include('channel.pages.home')
@endsection

@endif


@section('js')
@include('channel.layouts.js')
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}" type="text/javascript" charset="utf-8" async defer></script>
<script src="{{ asset('shop/js/categories_custom.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@if (Auth::check())
<script>
    $('#recipeCarousel').carousel({
        interval: 10000
    })

    $('.carousel .carousel-item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<2;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });

</script>
@endif

@endsection