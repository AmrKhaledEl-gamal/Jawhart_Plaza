@extends('front.layouts.app')

@section('content')
    <main>
        <header id="home" class="swiper mySwiper">
            <div class="swiper-wrapper" data-aos="fade">
                @foreach ($banners as $banner)
                    <article class="swiper-slide">
                        <div class="heroOverlay" style="position:relative; width:100%;">
                            <img src="{{ $banner->getFirstMediaUrl('banners') }}" alt="{{ $banner->title }}"
                                style="
                 width:1950px;
                 height:800PX;
             ">
                            <a href="{{ $banner->link }}" target="_blank" class="slide-link"
                                style="
               position:absolute;
               top:0;
               left:0;
               width:100%;
               height:100%;
               cursor:pointer;
           ">
                            </a>
                        </div>
                        <div class="container"></div>
                    </article>
                    ء
                @endforeach
                <div class="swiper-pagination"></div>
            </div>
        </header>

        <section id="productsAndCategories" class="products">
            <h2 class="intro underline" data-aos="fade-up">الاصناف والمنتجات</h2>

            <div class="container swiper productSwiper">
                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        <a class="swiper-slide" href="#">
                            <img src="{{ $product->getFirstMediaUrl('products') ?? '../images/product1.png' }}"
                                alt="{{ $product->title }}" />
                            <h3 class="productName">{{ $product->title }}</h3>
                        </a>
                    @endforeach
                </div>
                <div class="swiper-pagination product-pagination"></div>
            </div>

        </section>

        <section class="whoWe">
            <div class="container">
                <article class="whoWeImg" data-aos="fade-left">
                    <img src="{{ $about->getFirstMediaUrl('about_images') ?: '' }}" alt="who we" />
                </article>
                <article class="heroIntro" data-aos="fade-right" data-aos-delay="300">
                    <h2>مطاحن ومحامص الضياء </h2>
                    {!! $about->about !!}
                    <button type="button" class="contact">

                        <a href="{{ route('front.about') }}"> اقرأ المزيد<svg width="25" height="25"
                                viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.20833 10.4167C5.20833 9.84167 5.675 9.375 6.25 9.375H9.375V6.25C9.375 5.675 9.84167 5.20833 10.4167 5.20833C10.9917 5.20833 11.4583 5.675 11.4583 6.25V9.375H14.5833C15.1583 9.375 15.625 9.84167 15.625 10.4167C15.625 10.9917 15.1583 11.4583 14.5833 11.4583H11.4583V14.5833C11.4583 15.1583 10.9917 15.625 10.4167 15.625C9.84167 15.625 9.375 15.1583 9.375 14.5833V11.4583H6.25C5.675 11.4583 5.20833 10.9917 5.20833 10.4167ZM25 9.375V19.7917C25 22.6635 22.6635 25 19.7917 25H9.375C6.82708 25 4.70937 23.1583 4.2625 20.7375C1.84167 20.2906 0 18.1729 0 15.625V5.20833C0 2.33646 2.33646 0 5.20833 0H15.625C18.1729 0 20.2906 1.84167 20.7375 4.2625C23.1583 4.70937 25 6.82708 25 9.375ZM5.20833 18.75H15.625C17.3479 18.75 18.75 17.3479 18.75 15.625V5.20833C18.75 3.48542 17.3479 2.08333 15.625 2.08333H5.20833C3.48542 2.08333 2.08333 3.48542 2.08333 5.20833V15.625C2.08333 17.3479 3.48542 18.75 5.20833 18.75ZM22.9167 9.375C22.9167 8.01875 22.0427 6.87292 20.8333 6.44167V15.625C20.8333 18.4969 18.4969 20.8333 15.625 20.8333H6.44167C6.87292 22.0427 8.01875 22.9167 9.375 22.9167H19.7917C21.5146 22.9167 22.9167 21.5146 22.9167 19.7917V9.375Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </button>
                </article>
            </div>
        </section>


        <section id="topProducts" class="products">
            <h2 class="intro underline" data-aos="fade-up">المنتجات الأكثر طلباً </h2>

            <div class="container swiper productSwiper">
                <div class="swiper-wrapper">
                    @foreach ($products->where('is_active', true) as $product)
                        <a class="swiper-slide" href="#">
                            <img src="{{ $product->getFirstMediaUrl('products') ?? './images/product1.png' }}"
                                alt="{{ $product->title }}" />
                            <h3 class="productName">{{ $product->title }}</h3>
                        </a>
                    @endforeach
                </div>
                <div class="swiper-pagination product-pagination"></div>
            </div>

        </section>



        <section class="productGallery">
            <div class="container">
                @foreach ($categories as $index => $category)
                    <a href="{{ route('front.products.index', ['categories' => $category->id]) }}" data-aos="zoom-in-up"
                        class="{{ $index == 0 ? 'tallGrid' : ($index == 1 ? 'widerGrid' : '') }}">

                        <img src="{{ $category->getFirstMediaUrl('categories') ?: asset('images/no-image.png') }}"
                            alt="{{ $category->name }}">

                        <div class="gridOverlay">
                            <h2>{{ $category->name }}</h2>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
@endsection
