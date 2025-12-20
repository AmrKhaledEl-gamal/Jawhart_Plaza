@php
    $locale = app()->getLocale();
    $logoPath = $settings->site_logo ?? null;
    $siteName = $settings->site_name ?? config('app.name');
    if (is_array($siteName)) {
        $siteName = $siteName[$locale] ?? ($siteName['en'] ?? reset($siteName));
    }
@endphp

<nav>
    <div class="box f-s">
        <a href="{{ route('front.index') }}" class="logo">
            <img src="{{ $logoPath ? asset('storage/' . $logoPath) : asset('front/media/logo.png') }}"
                alt="{{ $siteName }}">
        </a>
        <div class="links">
            <div class="ls">
                <ul class="mainLinks">
                    <li><a class="link active" href="{{ route('front.index') }}">Home</a></li>
                    <li><a class="link" href="{{ asset('front/enpages/hoodies.html') }}"> Hoodies</a></li>
                    <li><a class="link" href="{{ asset('front/enpages/men.html') }}">Men</a></li>
                    <li><a class="link" href="{{ asset('front/enpages/women.html') }}"> Women</a></li>
                    <li><a class="link" href="{{ asset('front/enpages/kids.html') }}"> kids</a></li>
                    <li><a class="link" href="{{ route('front.shop.index') }}"> Shop</a></li>
                    <li>
                        <form class="search">
                            <input type="search" placeholder="Explore">
                            <button type="submit">
                                <i class="fa-regular fa-magnifying-glass"></i></a>
                            </button>
                        </form>
                    </li>
                </ul>
                <div class="mLinks">
                    <a href="./enpages/whishlist.html"><img class="cw30img"
                            src="{{ asset('front/media/icons/heart.svg') }}" alt=""> </a>
                    <button class="cart"><img class="cw30img" src="{{ asset('front/media/icons/bag1.svg') }}"
                            alt="">
                        <span>0</span></button>
                    <a class="fw500" href="front/enpages/login.html">
                        <img class="cw30img" src="{{ asset('front/media/icons/user.svg') }}" alt="">
                    </a>
                    <div class="drop">
                        <a href="#">
                            <img class="lang" src="{{ asset('front/media/icons/language.png') }}" alt="">
                            {{ strtoupper($locale) }}
                        </a>
                        <span class="dropMenu">
                            <a href="{{ route('lang.switch', 'en') }}">
                                <img class="lang" src="{{ asset('front/media/icons/language.png') }}" alt="">
                                EN
                            </a>
                            <a href="{{ route('lang.switch', 'ar') }}">
                                <img class="lang" src="{{ asset('front/media/icons/language.png') }}" alt="">
                                AR
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="last">
            <div class="mLinks">
                <a href="./enpages/whishlist.html"><img class="cw30img"
                        src="{{ asset('front/media/icons/heart.svg') }}" alt="">
                </a>
                <button class="cart"><img class="cw30img" src="{{ asset('front/media/icons/bag1.svg') }}"
                        alt="">
                    <span>0</span></button>
                <a class="fw500" href="#">
                    <img class="cw30img" src="{{ asset('front/media/icons/user.svg') }}" alt="user">
                </a>
                <div class="drop">
                    <a href="#">
                        <img class="lang" src="{{ asset('front/media/icons/language.png') }}" alt="">
                        {{ strtoupper($locale) }}
                    </a>
                    <span class="dropMenu">
                        <a href="{{ route('lang.switch', 'en') }}">
                            <img class="lang" src="{{ asset('front/media/icons/language.png') }}" alt=""> EN
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}">
                            <img class="lang" src="{{ asset('front/media/icons/language.png') }}" alt=""> AR
                        </a>
                    </span>
                </div>
            </div>
            <button class="menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>
