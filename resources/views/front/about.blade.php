@extends('front.layouts.app')
@section('content')
    <!-- Hero Section -->
    <div class="home hnpb">
        <img class="homeImg" src="{{ asset('front/media/home.png') }}" alt="">

        <div class="box ktx z2">
            <h1>{{ __('front.who_are_we') }}</h1>

            <p>
                {{ __('front.about_hero_description') }}
            </p>

            <a href="{{ route('front.shop.index') }}" class="store mt20">
                {{ __('front.shop_now') }}
            </a>
        </div>
    </div>
    <!-- About Section -->
    <div class="box about p100-20">
        <div class="aboutText aboutPageText">
            <h1 class="tru">
                {{ __('front.about_title') }}
            </h1>

            <article>
                <p>
                    {!! __('front.about_description') !!}
                </p>
            </article>
        </div>

        <img class="aImg" src="{{ asset('front/media/logo.png') }}" alt="">
    </div>

    <!-- Banner -->
    <div class="home pageBanner pageBanner2">
        <img class="homeImg" src="{{ asset('front/media/b2.png') }}" alt="">

        <div class="box ktx z2">
            <h1>
                {{ __('front.about_banner_title') }}
            </h1>

            <p>
                {{ __('front.about_banner_description') }}
            </p>

            <a class="store mt20" href="#">
                {{ __('front.order_now') }}
            </a>
        </div>
    </div>
@endsection
