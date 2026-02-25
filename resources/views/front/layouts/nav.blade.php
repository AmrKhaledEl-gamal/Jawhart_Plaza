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
                    <li><a class="link {{ request()->routeIs('front.index') ? 'active' : '' }}"
                            href="{{ route('front.index') }}">{{ __('front.home') }}</a></li>
                    <li><a class="link {{ request()->routeIs('front.shop.index') ? 'active' : '' }}"
                            href="{{ route('front.shop.index') }}">{{ __('front.shop') }}</a></li>
                    <li><a class="link {{ request()->routeIs('front.about') ? 'active' : '' }}"
                            href="{{ route('front.about') }}">{{ __('front.about') }}</a></li>
                    <li><a class="link {{ request()->routeIs('front.contact.*') ? 'active' : '' }}"
                            href="{{ route('front.contact.index') }}">{{ __('front.contact') }}</a></li>
                    <li>
                        <form class="search" action="{{ route('front.shop.index') }}" method="GET">
                            <input type="search" name="search" placeholder="{{ __('front.search') }}"
                                value="{{ request('search') }}">
                            <button type="submit">
                                <i class="fa-regular fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </li>
                </ul>
                <div class="mLinks">
                    @auth
                        <a href="{{ route('front.wishlist') }}" title="{{ __('front.my_wishlist') }}">
                            <img class="cw30img" src="{{ asset('front/media/icons/heart.svg') }}" alt="">
                            @if ($wishlistCount > 0)
                                <span class="badge">{{ $wishlistCount }}</span>
                            @endif
                        </a>
                        <button class="cart" title="{{ __('front.my_cart') }}">
                            <img class="cw30img" src="{{ asset('front/media/icons/bag1.svg') }}" alt="">
                            <span class="cart-badge"
                                style="{{ $cartCount == 0 ? 'display:none;' : '' }}">{{ $cartCount }}</span>
                        </button>
                        <div class="drop user-menu">
                            <a href="#" class="fw500">
                                <img class="cw30img" src="{{ asset('front/media/icons/user.svg') }}" alt="">
                            </a>
                            <span class="dropMenu">
                                <span class="user-name">{{ auth()->user()->name }}</span>
                                {{-- <a href="{{ route('front.cart') }}">{{ __('front.my_cart') }}</a> --}}
                                {{-- <a href="{{ route('front.wishlist') }}">{{ __('front.my_wishlist') }}</a> --}}
                                <form action="{{ route('front.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit">{{ __('front.logout') }}</button>
                                </form>
                            </span>
                        </div>
                    @else
                        <a href="{{ route('front.wishlist') }}" title="{{ __('front.my_wishlist') }}">
                            <img class="cw30img" src="{{ asset('front/media/icons/heart.svg') }}" alt="">
                        </a>
                        <a href="{{ route('front.cart') }}" class="cart" title="{{ __('front.my_cart') }}">
                            <img class="cw30img" src="{{ asset('front/media/icons/bag1.svg') }}" alt="">
                            <span class="cart-badge" style="display:none;">0</span>
                        </a>
                        <a class="fw500" href="{{ route('front.login') }}" title="{{ __('front.sign_in') }}">
                            <img class="cw30img" src="{{ asset('front/media/icons/user.svg') }}" alt="">
                        </a>
                    @endauth
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
                @auth
                    <a href="{{ route('front.wishlist') }}">
                        <img class="cw30img" src="{{ asset('front/media/icons/heart.svg') }}" alt="">
                        @if ($wishlistCount > 0)
                            <span class="badge">{{ $wishlistCount }}</span>
                        @endif
                    </a>
                    <button class="cart">
                        <img class="cw30img" src="{{ asset('front/media/icons/bag1.svg') }}" alt="">
                        <span class="cart-badge"
                            style="{{ $cartCount == 0 ? 'display:none;' : '' }}">{{ $cartCount }}</span>
                    </button>
                    <div class="drop user-menu">
                        <a class="fw500" href="#">
                            <img class="cw30img" src="{{ asset('front/media/icons/user.svg') }}" alt="user">
                        </a>
                        <span class="dropMenu">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            {{-- <a href="{{ route('front.cart') }}">{{ __('front.my_cart') }}</a>
                            <a href="{{ route('front.wishlist') }}">{{ __('front.my_wishlist') }}</a> --}}
                            <form action="{{ route('front.logout') }}" method="POST">
                                @csrf
                                <button type="submit">{{ __('front.logout') }}</button>
                            </form>
                        </span>
                    </div>
                @else
                    <a href="{{ route('front.wishlist') }}">
                        <img class="cw30img" src="{{ asset('front/media/icons/heart.svg') }}" alt="">
                    </a>
                    <a href="{{ route('front.cart') }}" class="cart">
                        <img class="cw30img" src="{{ asset('front/media/icons/bag1.svg') }}" alt="">
                        <span class="cart-badge" style="display:none;">0</span>
                    </a>
                    <a class="fw500" href="{{ route('front.login') }}">
                        <img class="cw30img" src="{{ asset('front/media/icons/user.svg') }}" alt="user">
                    </a>
                @endauth
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
            <button class="menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>
