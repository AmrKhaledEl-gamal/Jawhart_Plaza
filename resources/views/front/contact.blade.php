@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="../media/contact.png" alt="">
        <div class="box ktx z2">
            <h1>
                Have a question or a special request?
            </h1>
            <p>
                We're here to assist you! Reach out to us, and we'll get back to you as soon as possible. </p>
        </div>
    </div>


    <div class="contactPage">
        <div class="box contact">
            <form action="{{ route('front.contact.store') }}" method="POST" data-aos="fade-left"
                style="
                    PADDING: 0;
                    WIDTH: 50%;
                    display: FLEX;
                    FLEX-DIRECTION: column;
                    gap: 20px;">
                @csrf
                <div class="input">
                    <span>Full Name:</span>
                    <input type="text" name="name" placeholder="Full Name">
                </div>
                <div class="input">
                    <span>Email Address:</span>
                    <input type="email" name="email" placeholder="Email Address">
                </div>
                <div class="input">
                    <span>Phone Number:</span>
                    <input type="tel" name="phone" placeholder="Phone number with country code">
                </div>
                <div class="input">
                    <span>Message Content:</span>
                    <textarea name="message" placeholder="Message Content"></textarea>
                </div>
                <button class="store mla">Send</button>
            </form>
            <div class="infodata">
                <h1>Contact Details :</h1>
                <ul>
                    <li>
                        <img src="{{ asset('front/media/icons/call.png') }}" alt="">
                        <a href="tel:{{ $settings->phone_number }}" target="_blank">{{ $settings->phone_number }}</a>
                    </li>
                    <li>
                        <img src="{{ asset('front/media/icons/mail.png') }}" alt="">
                        <a href="mailto:info@jawhartplaza.com" target="_blank">Email : info@jawhartplaza.com</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
@endsection
