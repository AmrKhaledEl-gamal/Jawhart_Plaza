@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/order.png') }}" alt="">
        <div class="box ktx z2">
            <h2>{{ __('front.order_success_thanks') }} <span>{{ __('front.jawhart_plaza') }}</span>.
                {{ __('front.order_success_preparing') }}</h2>
        </div>
    </div>

    <div class="contactPage">
        <div class="box contact successPage">
            <div class="formcontrol">
                <div class="flexbb20">
                    <img class="aImg2" src="{{ asset('front/media/logo.png') }}" alt="Success Order Image">
                </div>
                <div class="btns btns2">
                    <button>
                        {{ __('front.order_successful') }}
                        <i class="fa-regular fa-circle-check"></i>
                    </button>
                </div>
            </div>
            <a href="{{ route('front.track-order.index') }}">{{ __('front.track_my_order') }} <i
                    class="fa-regular fa-angle-right"></i></a>
        </div>
    </div>
@endsection
