@extends('front.layouts.app')

@section('title', 'Jawhart Plaza')

@section('content')

    <!-- Start Home Slider -->
    @if ($banners->count() > 0)
        <div class="swiper homeSlider">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="home hnpb">
                            <img class="homeImg" src="{{ $banner->getFirstMediaUrl('banners') }}" alt="{{ $banner->title }}">
                            <div class="box ktx z2">
                                <h1 class="mw600">{!! $banner->title !!}</h1>
                                <p>{{ $banner->description }}</p>
                                <a href="{{ $banner->link ?? route('front.shop.index') }}"
                                    class="store mt20">{{ __('front.shop_now') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    @endif
    <!-- End Home Slider -->


    <!-- Start Shop By Category Icons -->
    @if ($categories->count() > 0)
        <div class="bgfff ptb50">
            <div class="h1" data-aos="fade-up">
                <h1>{{ __('front.shop_by_category') }}</h1>
            </div>

            <div class="box pt0">
                <div class="catsIn">
                    @foreach ($categories as $category)
                        <a href="{{ route('front.shop.index', ['category' => $category->id]) }}" class="catItem">
                            <img src="{{ $category->getFirstMediaUrl('categories') ?: asset('front/media/placeholder.png') }}"
                                alt="{{ $category->name }}">
                            <p>{{ $category->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- End Shop By Category Icons -->


    <!-- Start Top Selling -->
    @if ($topSellingProducts->count() > 0)
        <div class="bgfff ptb50">
            <div class="h1" data-aos="fade-up">
                <h1>{{ __('front.top_selling') }}</h1>
            </div>

            <div class="box pt0">
                <a href="{{ route('front.shop.index', ['sort' => 'top_selling']) }}"
                    class="store moreBtn mb10">{{ __('front.view_all') }}</a>

                <div class="swiper imagesSlider2" id="imagesSlider">
                    <div class="swiper-wrapper">
                        @foreach ($topSellingProducts as $product)
                            @php
                                $avgRating = $product->reviews->avg('rating') ?? 0;
                                $reviewsCount = $product->reviews->count();
                            @endphp
                            <div class="swiper-slide">
                                <div class="prod">
                                    <div class="addToFav" tabindex="0" data-product-id="{{ $product->id }}">
                                        <i
                                            class="{{ in_array($product->id, $wishlistIds ?? []) ? 'fa-solid' : 'fa-light' }} fa-heart"></i>
                                    </div>

                                    <a href="{{ route('front.products.show', $product->slug) }}" class="prodImage">
                                        <img src="{{ $product->getFirstMediaUrl('products') ?: asset('front/media/placeholder.png') }}"
                                            alt="{{ $product->name }}">
                                    </a>

                                    <div class="nAndr">
                                        <h2>{{ $product->name }}</h2>
                                        <div class="rate">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= round($avgRating))
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-light fa-star"></i>
                                                @endif
                                            @endfor
                                            <span>({{ $reviewsCount }})</span>
                                        </div>
                                    </div>

                                    <div class="price">
                                        @if ($product->discount_price && $product->discount_price < $product->price)
                                            <span>{{ number_format($product->discount_price, 2) }}
                                                {{ __('front.currency') }}</span>
                                            <del>{{ number_format($product->price, 2) }} {{ __('front.currency') }}</del>
                                            @php
                                                $discountPercent = round(
                                                    (($product->price - $product->discount_price) / $product->price) *
                                                        100,
                                                );
                                            @endphp
                                            <span>{{ $discountPercent }}% {{ __('front.off') }}</span>
                                        @else
                                            <span>{{ number_format($product->price, 2) }}
                                                {{ __('front.currency') }}</span>
                                        @endif
                                    </div>

                                    <div class="btns">
                                        <a href="{{ route('front.products.show', $product->slug) }}"
                                            class="add-to-cart-link">
                                            {{ __('front.add_to_cart') }}
                                            <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- End Top Selling -->


    <!-- Start Category Sections with Banners -->
    @foreach ($categories as $index => $category)
        @if ($category->products->count() > 0)
            <!-- Category Section -->
            <div class="bgfff ptb50">
                <div class="h1" data-aos-duration="600" data-aos="fade-up">
                    <h1>{{ $category->name }}</h1>
                </div>
                <div class="box mt20">
                    <a href="{{ route('front.shop.index', ['category' => $category->id]) }}"
                        class="store moreBtn mb10">{{ __('front.view_all') }}</a>
                    <div class="swiper imagesSlider2" id="categorySlider{{ $index }}">
                        <div class="swiper-wrapper">
                            @foreach ($category->products as $product)
                                @php
                                    $avgRating = $product->reviews->avg('rating') ?? 0;
                                    $reviewsCount = $product->reviews->count();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="prod">
                                        <div class="addToFav" tabindex="0" data-product-id="{{ $product->id }}">
                                            <i
                                                class="{{ in_array($product->id, $wishlistIds ?? []) ? 'fa-solid' : 'fa-light' }} fa-heart"></i>
                                        </div>

                                        <a href="{{ route('front.products.show', $product->slug) }}" class="prodImage">
                                            <img src="{{ $product->getFirstMediaUrl('products') ?: asset('front/media/placeholder.png') }}"
                                                alt="{{ $product->name }}">
                                        </a>

                                        <div class="nAndr">
                                            <h2>{{ $product->name }}</h2>
                                            <div class="rate">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($avgRating))
                                                        <i class="fa-solid fa-star"></i>
                                                    @else
                                                        <i class="fa-light fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ $reviewsCount }})</span>
                                            </div>
                                        </div>

                                        <div class="price">
                                            @if ($product->discount_price && $product->discount_price < $product->price)
                                                <span>{{ number_format($product->discount_price, 2) }}
                                                    {{ __('front.currency') }}</span>
                                                <del>{{ number_format($product->price, 2) }}
                                                    {{ __('front.currency') }}</del>
                                                @php
                                                    $discountPercent = round(
                                                        (($product->price - $product->discount_price) /
                                                            $product->price) *
                                                            100,
                                                    );
                                                @endphp
                                                <span>{{ $discountPercent }}% {{ __('front.off') }}</span>
                                            @else
                                                <span>{{ number_format($product->price, 2) }}
                                                    {{ __('front.currency') }}</span>
                                            @endif
                                        </div>

                                        <div class="btns">
                                            <a href="{{ route('front.products.show', $product->slug) }}"
                                                class="add-to-cart-link">
                                                {{ __('front.add_to_cart') }}
                                                <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner after first category -->
            @if ($index === 0)
                <div class="home pageBanner pageBanner2">
                    <img class="homeImg" src="{{ asset('front/media/b1.png') }}" alt="">
                    <div class="box ktx z2">
                        <h1 class="tru">{!! __('front.most_popular') !!}</h1>
                        <p>{{ __('front.dont_miss_out') }}</p>
                        <a class="store mt20" href="{{ route('front.shop.index') }}">{{ __('front.order_now') }}</a>
                    </div>
                </div>
            @endif

            <!-- Why Choose Us after second category -->
            @if ($index === 1)
                <div class="bgfff ptb50">
                    <div class="h1" data-aos-duration="600" data-aos="fade-up">
                        <h1>{{ __('front.why_choose_us') }}</h1>
                    </div>
                    <div class="whyUsInner">
                        <div class="box whyUs">
                            <div class="why" data-aos-duration="600" data-aos="fade-down">
                                <img src="{{ asset('front/media/icons/why-us/1.svg') }}" alt="">
                                <div class="text">
                                    <span>{{ __('front.free_shipping') }}</span>
                                    <span>{{ __('front.on_purchase_over') }}</span>
                                </div>
                            </div>
                            <div class="why" data-aos-duration="600" data-aos="fade-down">
                                <img src="{{ asset('front/media/icons/why-us/2.svg') }}" alt="">
                                <div class="text">
                                    <span>{{ __('front.money_back') }}</span>
                                    <span>{{ __('front.on_purchase_over') }}</span>
                                </div>
                            </div>
                            <div class="why" data-aos-duration="600" data-aos="fade-down">
                                <img src="{{ asset('front/media/icons/why-us/3.svg') }}" alt="">
                                <div class="text">
                                    <span>{{ __('front.easy_payment') }}</span>
                                    <span>{{ __('front.secure_payment_desc') }}</span>
                                </div>
                            </div>
                            <div class="why" data-aos-duration="600" data-aos="fade-down">
                                <img src="{{ asset('front/media/icons/why-us/4.svg') }}" alt="">
                                <div class="text">
                                    <span>{{ __('front.finest_quality') }}</span>
                                    <span>{{ __('front.finest_quality_desc') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
    <!-- End Category Sections -->


    <!-- Start Subscribe -->
    <div class="subscribe">
        <img src="{{ asset('front/media/subscribe-banner.png') }}" alt="">
        <div class="subI">
            <p>{{ __('front.subscribe_desc') }}</p>
            <form class="emailInput">
                <input type="email" placeholder="{{ __('front.enter_email') }}">
                <button type="submit">{{ __('front.subscribe') }}</button>
            </form>
        </div>
    </div>
    <!-- End Subscribe -->

@endsection

@section('scripts')
    <script>
        // Initialize additional swipers for category sliders
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($categories as $index => $category)
                new Swiper('#categorySlider{{ $index }}', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    breakpoints: {
                        640: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 3
                        },
                        1024: {
                            slidesPerView: 4
                        }
                    }
                });
            @endforeach
        });
    </script>
@endsection
