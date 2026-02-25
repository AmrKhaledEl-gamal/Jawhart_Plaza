@extends('front.layouts.app')
@section('content')
    <div class="box textPageInner">
        <h2>{{ __('front.privacy_policy') }}</h2>
        <div class="tcont">
            <h2>{{ __('front.comments_title') }}</h2>
            <p>{{ __('front.comments_1') }}</p>
            <p>{{ __('front.comments_2') }}</p>
            <h2>{{ __('front.media_title') }}</h2>
            <p>{{ __('front.media_1') }}</p>
            <h2>{{ __('front.cookies_title') }}</h2>
            <p>{{ __('front.cookies_1') }}</p>
            <p>{{ __('front.cookies_2') }}</p>
            <p>{{ __('front.cookies_3') }}</p>
            <p>{{ __('front.cookies_4') }}</p>
            <h2>{{ __('front.embedded_content_title') }}</h2>
            <p>{{ __('front.embedded_content_1') }}</p>
            <p>{{ __('front.embedded_content_2') }}</p>
            <h2>{{ __('front.data_sharing_title') }}</h2>
            <p>{{ __('front.data_sharing_1') }}</p>
            <h2>{{ __('front.data_retention_title') }}</h2>
            <p>{{ __('front.data_retention_1') }}</p>
            <p>{{ __('front.data_retention_2') }}</p>
            <h2>{{ __('front.data_rights_title') }}</h2>
            <p>{{ __('front.data_rights_1') }}</p>
            <h2>{{ __('front.data_destination_title') }}</h2>
            <p>{{ __('front.data_destination_1') }}</p>
        </div>
    </div>
@endsection
