@extends('front.layouts.app')

@section('title', 'Jawhart Plaza')

@section('content')

    <!-- Start Cart -->
    <div class="cartInner">
        <div class="cartBody">
            <h2>{{ __('front.order_summary') }}: <i class="fa-light fa-backward-fast"></i></h2>
            <div class="itemsIncart">
                <div class="itDcart">
                    <img src="{{ asset('front/media/DONE1OUT.png') }}" alt="">
                    <div class="itdd">
                        <h3>{{ __('front.product_name') }}</h3>
                        <span>25JD</span>
                    </div>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
                <div class="itDcart">
                    <img src="{{ asset('front/media/DONE1OUT.png') }}" alt="">
                    <div class="itdd">
                        <h3>{{ __('front.product_name') }}</h3>
                        <span>25JD</span>
                    </div>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
            </div>

            <div class="total">
                <span>{{ __('front.total') }}:</span>
                <span>50JD</span>
            </div>

            <div class="btns btns3">
                <a href="#">{{ __('front.proceed_to_payment') }}</a>
                <a href="#">{{ __('front.view_cart') }}</a>
            </div>
        </div>
    </div>
    <!-- End Cart -->


    <!-- Start Home Slider -->
    <div class="swiper homeSlider">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="swiper-slide">
                    <div class="home hnpb">
                        <img class="homeImg" src="{{ $banner->getFirstMediaUrl('banners') }}" alt="">
                        <div class="box ktx z2 ">
                            <h1 class="mw600">{!! $banner->title !!}</h1>
                            <p>{{ $banner->description }}</p>
                            <a href="{{ $banner->link }}" class="store mt20">{{ __('front.shop_now') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- End Home Slider -->


    <!-- Start Categories -->
    <div class="bgfff ptb50">
        <div class="h1" data-aos="fade-up">
            <h1>{{ __('front.shop_by_category') }}</h1>
        </div>

        <div class="box pt0">
            <div class="catsIn">
                @foreach ($categories as $category)
                    <a {{-- href="{{ route('shop', ['category' => $category->id]) }}" --}} class="catItem">
                        <img src="{{ $category->getFirstMediaUrl('categories') }}" alt="{{ $category->name }}">
                        <p>{{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->


    <!-- Start Top Selling -->
    <div class="bgfff ptb50">
        <div class="h1" data-aos="fade-up">
            <h1>{{ __('front.top_selling') }}</h1>
        </div>

        <div class="box pt0">
            <a href={{-- "{{ route('shop') }}" --}} class="store moreBtn mb10"> {{ __('front.view_all') }} </a>

            <div class="swiper imagesSlider2" id="imagesSlider">
                <div class="swiper-wrapper">

                    @foreach ($products as $product)
                        <div class="swiper-slide">
                            <div class="prod">

                                <div class="addToFav" tabindex="0">
                                    <i class="fa-light fa-heart"></i>
                                </div>

                                <a {{-- href="{{ route('product.show', $product->id) }}" --}} class="prodImage">
                                    <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->name }}">
                                </a>

                                <div class="nAndr">
                                    <h2>{{ $product->name }}</h2>
                                    <div class="rate">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-light fa-star"></i>
                                        <span>(112)</span>
                                    </div>
                                </div>

                                <div class="price">
                                    <span>{{ $product->price }} JD</span>
                                    @if ($product->sale_price)
                                        <del>{{ $product->sale_price }} JD</del>
                                        <span>{{ round((($product->sale_price - $product->price) / $product->sale_price) * 100) }}
                                            % {{ __('front.off') }}</span>
                                    @endif
                                </div>

                                <div class="btns">
                                    <button>
                                        {{ __('front.add_to_cart') }}
                                        <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Top Selling -->
    <div class="bgfff ptb50">
        <div class="h1" data-aos-duration="600" data-aos="fade-up">
            <h1>Category Name 1</h1>
        </div>
        <div class="box mt20">
            <a href="front/enpages/cat.html" class="store moreBtn mb10"> {{ __('front.view_all') }} </a>
            <div class="swiper imagesSlider2" id="imagesSlider2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="prod">
                            <div class="addToFav" tabindex="0">
                                <i class="fa-light fa-heart"></i>
                            </div>
                            <a href="front/enpages/product.html" class="prodImage">
                                <img src="{{ asset('front/media/p3.png') }}" alt="">
                            </a>
                            <div class="nAndr">
                                <h2>{{ __('front.product_name') }}</h2>
                                <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-light fa-star"></i>
                                    <span>(112)</span>
                                </div>
                            </div>
                            <div class="price">
                                <span>40 JD</span>
                                <del>60 JD</del>
                                <span>20 % {{ __('front.off') }}</span>
                            </div>
                            <div class="btns">
                                <button onclick="AddToCart(data[5])">
                                    {{ __('front.add_to_cart') }}
                                    <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Banner -->
    <div class="home pageBanner pageBanner2">
        <img class="homeImg" src="{{ asset('front/media/b1.png') }}" alt="">
        <div class="box ktx z2">
            <h1 class="tru">
                {!! __('front.most_popular') !!}
            </h1>
            <p>
                {{ __('front.dont_miss_out') }}
            </p>
            <a class="store mt20" href="##">
                {{ __('front.order_now') }}
            </a>
        </div>
    </div>
    <!-- End Banner -->

    <div class="bgfff ptb50">
        <div class="h1" data-aos-duration="600" data-aos="fade-up">
            <h1>Category Name 2</h1>
        </div>
        <div class="box pt0">
            <a href="front/enpages/cat.html" class="store moreBtn mb10"> {{ __('front.view_all') }} </a>
            <div class="swiper imagesSlider2" id="imagesSlider3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="prod">
                            <div class="addToFav" tabindex="0">
                                <i class="fa-light fa-heart"></i>
                            </div>
                            <a href="front/enpages/product.html" class="prodImage">
                                <img src="{{ 'front/media/p2.png' }}" alt="">
                            </a>
                            <div class="nAndr">
                                <h2>{{ __('front.product_name') }}</h2>
                                <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-light fa-star"></i>
                                    <span>(112)</span>
                                </div>
                            </div>
                            <div class="price">
                                <span>40 JD</span>
                                <del>60 JD</del>
                                <span>20 % {{ __('front.off') }}</span>
                            </div>
                            <div class="btns">
                                <button onclick="AddToCart(data[0])">
                                    {{ __('front.add_to_cart') }}
                                    <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start why us -->
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
    <!-- End why us -->

    <div class="bgfff ptb50">
        <div class="h1" data-aos-duration="600" data-aos="fade-up">
            <h1>Category Name 3</h1>
        </div>
        <div class="box pt0">
            <a href="front/enpages/cat.html" class="store moreBtn mb10"> {{ __('front.view_all') }} </a>
            <div class="swiper imagesSlider2" id="imagesSlider4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="prod">
                            <div class="addToFav" tabindex="0">
                                <i class="fa-light fa-heart"></i>
                            </div>
                            <a href="front/enpages/product.html" class="prodImage">
                                <img src="{{ asset('front/media/p2.png') }}" alt="">
                            </a>
                            <div class="nAndr">
                                <h2>{{ __('front.product_name') }}</h2>
                                <div class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-light fa-star"></i>
                                    <span>(112)</span>
                                </div>
                            </div>
                            <div class="price">
                                <span>40 JD</span>
                                <del>60 JD</del>
                                <span>20 % {{ __('front.off') }}</span>
                            </div>
                            <div class="btns">
                                <button onclick="AddToCart(data[0])">
                                    {{ __('front.add_to_cart') }}
                                    <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Srart Subscribe -->
    <div class="subscribe">
        <img src="{{ asset('front/media/subscribe-banner.png') }}" alt="">
        <div class="subI">
            <p>
                {{ __('front.subscribe_desc') }}
            </p>
            <form class="emailInput">
                <input type="email" placeholder="{{ __('front.enter_email') }}">
                <button type="submit">{{ __('front.subscribe') }}</button>
            </form>
        </div>
    </div>
    <!-- End Subscribe -->


@endsection
