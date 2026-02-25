@extends('front.layouts.app')
@section('content')
    <div class="box textPageInner">
        <h2>{{ __('front.buying_guide') }}</h2>
        <div class="tcont">
            <h2>{{ __('front.bg_intro_title') }}</h2>
            <p>{{ __('front.bg_intro_text') }}</p>

            <h2>{{ __('front.bg_step1_title') }}</h2>
            <p>{{ __('front.bg_step1_text') }}</p>

            <h2>{{ __('front.bg_step2_title') }}</h2>
            <p>{{ __('front.bg_step2_text') }}</p>

            <h2>{{ __('front.bg_step3_title') }}</h2>
            <p>{{ __('front.bg_step3_text') }}</p>

            <h2>{{ __('front.bg_step4_title') }}</h2>
            <p>{{ __('front.bg_step4_text') }}</p>

            <h2>{{ __('front.bg_help_title') }}</h2>
            <p>{!! __('front.bg_help_text', [
                'contact_link' => '<a href="' . route('front.contact.index') . '">' . __('front.tc_contact_link') . '</a>',
            ]) !!}</p>
        </div>
    </div>
@endsection
