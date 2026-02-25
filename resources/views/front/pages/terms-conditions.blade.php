@extends('front.layouts.app')
@section('content')
    <div class="box textPageInner">
        <h2>{{ __('front.terms_conditions') }}</h2>
        <div class="tcont">
            <h2>{{ __('front.tc_intro_title') }}</h2>
            <p>{{ __('front.tc_intro_text') }}</p>

            <h2>{{ __('front.tc_eligibility_title') }}</h2>
            <p>{{ __('front.tc_eligibility_text') }}</p>

            <h2>{{ __('front.tc_account_title') }}</h2>
            <p>{{ __('front.tc_account_text') }}</p>

            <h2>{{ __('front.tc_product_title') }}</h2>
            <p>{{ __('front.tc_product_text') }}</p>

            <h2>{{ __('front.tc_orders_title') }}</h2>
            <p>{{ __('front.tc_orders_text') }}</p>

            <h2>{{ __('front.tc_shipping_title') }}</h2>
            <p>{{ __('front.tc_shipping_text') }}</p>

            <h2>{{ __('front.tc_returns_title') }}</h2>
            <p>{{ __('front.tc_returns_text') }}</p>

            <h2>{{ __('front.tc_ip_title') }}</h2>
            <p>{{ __('front.tc_ip_text') }}</p>

            <h2>{{ __('front.tc_liability_title') }}</h2>
            <p>{{ __('front.tc_liability_text') }}</p>

            <h2>{{ __('front.tc_changes_title') }}</h2>
            <p>{{ __('front.tc_changes_text') }}</p>

            <h2>{{ __('front.tc_law_title') }}</h2>
            <p>{{ __('front.tc_law_text') }}</p>

            <h2>{{ __('front.tc_contact_title') }}</h2>
            <p>{!! __('front.tc_contact_text', [
                'contact_link' => '<a href="' . route('front.contact.index') . '">' . __('front.tc_contact_link') . '</a>',
            ]) !!}</p>
        </div>
    </div>
@endsection
