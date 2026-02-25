@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4 pageBanner5">
        <img class="pageBannerImage" src="{{ asset('front/media/checkout.png') }}" alt="">
    </div>

    <div class="contactPage">
        <div class="box contact">
            <div class="formcontrol">
                <h2> {{ __('front.payment') }}</h2>
                <form class="form">
                    <div class="input">
                        <span> {{ __('front.card_number') }}:</span>
                        <div class="select cardNum">
                            <input type="text" id="cardNum" placeholder="XXXX XXXX XXXX XXXX" maxlength="19"
                                pattern="\d{12,19}" title="{{ __('front.card_number_title') }}" inputmode="numeric"
                                autocomplete="cc-number">
                            <i class="fa-brands fa-cc-visa" id="visaIcon" style="display: none;"></i>
                            <i class="fa-brands fa-cc-mastercard" id="mastercardIcon" style="display: none;"></i>
                        </div>
                    </div>

                    <div class="inputs">
                        <div class="input">
                            <span> {{ __('front.expiry_date') }}:</span>
                            <input type="text" id="date" autocomplete="cc-exp" maxlength="5" pattern="\d{2}/\d{2}"
                                title="{{ __('front.expiry_date_title') }}" placeholder="MM/YY">
                        </div>
                        <div class="input">
                            <span>{{ __('front.cvv') }}:</span>
                            <input id="cvv" type="text" placeholder="XXX" maxlength="3" pattern="\d{3}"
                                title="{{ __('front.cvv_title') }}" autocomplete="cc-csc">
                        </div>
                    </div>

                    <div class="btns btns3 p0m0 pt20">
                        <a href="{{ route('front.checkout.success') }}"> {{ __('front.complete_payment') }}</a>
                        <!-- <button> Complete Payment</button> -->
                        <a href="{{ route('front.checkout.index') }}" class="store moreBtn mla">
                            {{ __('front.return_to_order_summary') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
