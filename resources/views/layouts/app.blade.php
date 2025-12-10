<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('front/media/tap-icon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('front/media/tap-icon.svg') }}" />
    <link rel="apple-touch-icon" href="{{ asset('front/media/tap-icon.svg') }}" />
    <meta name="color-scheme" content="light only">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('front/js/swiper-bundle.min.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('front/arscss/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('front/enscss/style.css') }}">
    @endif
    <title>Jawhart Plaza</title>
</head>

<body>

    <!-- Start Cart -->
    <div class="cartInner">
        <div class="cartBody">
            <h2>Order Summary: <i class="fa-light fa-backward-fast"></i></h2>
            <div class="itemsIncart">
                <div class="itDcart">
                    <img src="{{ asset('front/media/DONE1OUT.png') }}" alt="">
                    <div class="itdd">
                        <h3>Product Name</h3>
                        <span>25JD</span>
                    </div>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
                <div class="itDcart">
                    <img src="{{ asset('front/media/DONE1OUT.png') }}" alt="">
                    <div class="itdd">
                        <h3>Product Name</h3>
                        <span>25JD</span>
                    </div>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
            </div>
            <div class="total">
                <span>Total:</span>
                <span>50JD</span>
            </div>
            <div class="btns btns3">
                <a href="{{ asset('front/enpages/checkout.html') }}">
                    Proceed to Payment
                </a>
                <a href="{{ asset('front/enpages/cart.html') }}">
                    View Cart
                </a>
            </div>
        </div>
    </div>
    <!-- End Cart -->



    <!-- Start Nav -->
    @include('layouts.nav')

    @yield('content')
