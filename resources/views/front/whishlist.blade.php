@extends('front.layouts.app')

@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/wishlist.png') }}" alt="">
        <div class="box ktx z2">
            <h1 class="trc">{{ __('front.my_wishlist') }}</h1>
        </div>
    </div>

    <div class="bgfff p70-0">
        <div class="box proandf pr">
            @if (session('success'))
                <div class="alert alert-success w100">{{ session('success') }}</div>
            @endif

            <div class="projectsInner w100">
                @if ($wishlistItems->count() > 0)
                    <div class="projects">
                        @foreach ($wishlistItems as $wishlistItem)
                            @php
                                $product = $wishlistItem->product;
                                $avgRating = $product->reviews->avg('rating') ?? 0;
                            @endphp
                            <div class="prod" data-wishlist-item-id="{{ $wishlistItem->id }}">
                                <button type="button" class="wishlist-delete-btn"
                                    data-wishlist-id="{{ $wishlistItem->id }}" data-product-id="{{ $product->id }}"
                                    onclick="deleteFromWishlist({{ $wishlistItem->id }}, this)">
                                    <i class="fa-light fa-trash-can"></i>
                                </button>
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
                                        <span>({{ $product->reviews->count() }})</span>
                                    </div>
                                </div>
                                <div class="price">
                                    @if ($product->discount_price && $product->discount_price < $product->price)
                                        <span>{{ number_format($product->discount_price, 2) }}
                                            {{ __('front.currency') }}</span>
                                        <del>{{ number_format($product->price, 2) }} {{ __('front.currency') }}</del>
                                        @php
                                            $discountPercent = round(
                                                (($product->price - $product->discount_price) / $product->price) * 100,
                                            );
                                        @endphp
                                        <span>{{ $discountPercent }}% {{ __('front.off') }}</span>
                                    @else
                                        <span>{{ number_format($product->price, 2) }} {{ __('front.currency') }}</span>
                                    @endif
                                </div>
                                <div class="btns">
                                    @if ($product->variants->count() > 0)
                                        <a href="{{ route('front.products.show', $product->slug) }}"
                                            class="add-to-cart-btn">
                                            {{ __('front.add_to_cart') }}
                                            <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                        </a>
                                    @else
                                        <button disabled>{{ __('front.out_of_stock') }}</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($wishlistItems->hasPages())
                        <div class="paginationCont">
                            <div class="paginations">
                                <ul class="spans">
                                    {{-- Previous Page Link --}}
                                    @if ($wishlistItems->onFirstPage())
                                        <li><span class="page-link disabled"><img
                                                    src="{{ asset('front/media/icons/arrow-prev.svg') }}"
                                                    alt=""></span></li>
                                    @else
                                        <li><a href="{{ $wishlistItems->previousPageUrl() }}" class="page-link"><img
                                                    src="{{ asset('front/media/icons/arrow-prev.svg') }}"
                                                    alt=""></a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($wishlistItems->links()->elements as $element)
                                        @if (is_string($element))
                                            <li><span class="page-link">{{ $element }}</span></li>
                                        @endif

                                        @if (is_array($element))
                                            @foreach ($element as $page => $url)
                                                @if ($page == $wishlistItems->currentPage())
                                                    <li><span class="page-link active">{{ $page }}</span></li>
                                                @else
                                                    <li><a href="{{ $url }}"
                                                            class="page-link">{{ $page }}</a></li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($wishlistItems->hasMorePages())
                                        <li><a href="{{ $wishlistItems->nextPageUrl() }}" class="page-link"><img
                                                    src="{{ asset('front/media/icons/arrow-next.svg') }}"
                                                    alt=""></a></li>
                                    @else
                                        <li><span class="page-link disabled"><img
                                                    src="{{ asset('front/media/icons/arrow-next.svg') }}"
                                                    alt=""></span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="empty-wishlist">
                        <div class="empty-message">
                            <i class="fa-light fa-heart"></i>
                            <h2>{{ __('front.wishlist_empty') }}</h2>
                            <p>{{ __('front.wishlist_empty_message') }}</p>
                            <a href="{{ route('front.shop.index') }}"
                                class="store">{{ __('front.continue_shopping') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
