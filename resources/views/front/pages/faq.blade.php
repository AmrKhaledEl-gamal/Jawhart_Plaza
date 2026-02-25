@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/faq.png') }}" alt="">
        <div class="box ktx z2">
            <h1>{{ __('front.faq_title') }}</h1>
        </div>
    </div>

    <div class="box about" id="about">
        <div class="aboutText aboutPageText">
            <h1>
                {{ __('front.faq_welcome') }}
            </h1>
            <article>
                <p>
                    {{ __('front.faq_description') }}
                </p>
            </article>
        </div>
    </div>

    <div class="box">
        <div class="faqs">
            @forelse($faqs as $faq)
                <div class="faq">
                    <div class="faq-title">
                        <h3>
                            <i class="fa-light fa-angle-left"></i>
                            {{ $faq->question }}
                        </h3>
                    </div>
                    <p>
                        {{ $faq->answer }}
                    </p>
                </div>
            @empty
                <p style="text-align: center; width: 100%;">{{ __('front.no_faqs_found') }}</p>
            @endforelse
        </div>
    </div>
@endsection
