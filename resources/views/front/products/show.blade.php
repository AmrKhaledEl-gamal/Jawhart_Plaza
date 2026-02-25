@extends('front.layouts.app')

@section('content')
    <!-- Product Details -->
    <div class="contactPage p020 pb0 t0">
        <div class="box contact productContainer productContainer2">
            <div class="productImages">
                <div class="swiper productImagesSwiper" id="productImages">
                    <div class="swiper-wrapper">
                        @forelse($productImages as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}">
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <img src="{{ asset('front/media/placeholder.png') }}" alt="{{ $product->name }}">
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="controlBtns">
                    <div class="swiper-pagination pagination"></div>
                </div>
            </div>

            <form class="formcontrol" id="add-to-cart-form" action="{{ route('front.cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="prod">
                    <div class="catName">
                        @if ($product->category)
                            <a href="{{ route('front.shop.index', ['categories' => [$product->category->id]]) }}">
                                {{ $product->category->name }}
                            </a>
                        @endif
                    </div>
                    <div class="nAndr">
                        <h2>{{ $product->name }}</h2>
                        <div class="rate">
                            @php
                                $rating = round($avgRating);
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-light fa-star"></i>
                                @endif
                            @endfor
                            <span>({{ $reviewsCount }})</span>
                        </div>
                    </div>
                    <p>{{ $product->description }}</p>
                    <div class="price">
                        @if ($product->discount_price && $product->discount_price < $product->price)
                            <span>{{ number_format($product->discount_price, 2) }} {{ __('front.currency') }}</span>
                            <del>{{ number_format($product->price, 2) }} {{ __('front.currency') }}</del>
                            @php
                                $discountPercent = round(
                                    (($product->price - $product->discount_price) / $product->price) * 100,
                                );
                            @endphp
                            <span class="discount-badge">{{ $discountPercent }}% {{ __('front.off') }}</span>
                        @else
                            <span>{{ number_format($product->price, 2) }} {{ __('front.currency') }}</span>
                        @endif
                    </div>
                </div>

                <div class="filter">
                    @if ($availableSizes->count() > 0)
                        <div class="filtSection">
                            <h3>{{ __('front.size') }}</h3>
                            <div class="radiosIn">
                                @foreach ($availableSizes as $index => $size)
                                    <div class="labelinput radio">
                                        <input type="radio" id="size-{{ $size->id }}" name="size_id"
                                            value="{{ $size->id }}" {{ $index === 0 ? 'checked' : '' }} required>
                                        <label for="size-{{ $size->id }}">{{ $size->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($availableColors->count() > 0)
                        <div class="filtSection">
                            <h3>{{ __('front.color') }}</h3>
                            <div class="radiosIn">
                                @foreach ($availableColors as $index => $color)
                                    <div class="labelinput radio colorradio">
                                        <input type="radio" id="color-{{ $color->id }}" name="color_id"
                                            value="{{ $color->id }}" {{ $index === 0 ? 'checked' : '' }} required>
                                        <label for="color-{{ $color->id }}"
                                            style="background-color: {{ $color->code }};"
                                            title="{{ $color->code }}"></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="count mt20">
                        <button type="button" onclick="decrementQty()">-</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                            max="{{ $totalStock }}">
                        <button type="button" onclick="incrementQty()">+</button>
                    </div>

                    <div class="info">
                        @if ($totalStock > 0)
                            <span>{{ __('front.only') }} <b>{{ $totalStock }} {{ __('front.items') }}</b>
                                {{ __('front.left') }}</span>
                            <span>{{ __('front.dont_miss') }}</span>
                        @else
                            <span class="out-of-stock">{{ __('front.out_of_stock') }}</span>
                        @endif
                    </div>
                </div>

                <div class="btns btns2 btns4">
                    <button type="submit" {{ $totalStock <= 0 ? 'disabled' : '' }}>
                        {{ __('front.add_to_cart') }}
                        <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                    </button>
                    <div class="addToFav" tabindex="0" data-product-id="{{ $product->id }}">
                        <i class="{{ $isInWishlist ? 'fa-solid' : 'fa-light' }} fa-heart"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Details and Reviews Tabs -->
    <div class="detailsandrate">
        <div class="box">
            <div class="secs">
                <button class="active" onclick="showTab('details', this)">{{ __('front.details') }}</button>
                <button onclick="showTab('reviews', this)">{{ __('front.reviews') }} ({{ $reviewsCount }})</button>
            </div>

            <!-- Start Details -->
            <div class="pb50" id="details">
                @if ($product->description)
                    <div class="detailsSec">
                        <h3>{{ __('front.product_description') }}</h3>
                        <p>{{ $product->description }}</p>
                    </div>
                @endif

                <div class="detailsSec">
                    <h3>{{ __('front.shipping_details') }}</h3>
                    <ul>
                        <li>{{ __('front.shipping_note_1') }}</li>
                        <li>{{ __('front.shipping_note_2') }}</li>
                        <li>{{ __('front.shipping_note_3') }}</li>
                    </ul>
                </div>

                <div class="scrollTable">
                    <table class="tg" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>{{ __('front.shipping_by') }}</th>
                                <th>{{ __('front.shipping_cost') }}</th>
                                <th>{{ __('front.estimated_delivery') }}</th>
                                <th>{{ __('front.tracking_info') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Express</td>
                                <td>{{ __('front.free_shipping') }}</td>
                                <td>3-5 {{ __('front.days') }}</td>
                                <td>{{ __('front.available') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Details -->

            <!-- Start Reviews -->
            <div class="pb50" id="reviews" style="display: none;">
                <!-- Existing Reviews -->
                @if ($product->reviews->count() > 0)
                    <div class="existing-reviews mb-4">
                        <h3>{{ __('front.customer_reviews') }}</h3>
                        @foreach ($product->reviews as $review)
                            <div class="review-item mb-3 p-3 border rounded">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $review->name }}</strong>
                                    <div class="rate">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="fa-solid fa-star"></i>
                                            @else
                                                <i class="fa-light fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="mt-2">{{ $review->comment }}</p>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Review Form -->
                @auth
                    <form action="{{ route('front.products.review', $product) }}" method="POST" class="review-form">
                        @csrf
                        <div class="yourRating">
                            <input type="hidden" name="rating" id="rating-input" value="5" required>
                            <p>{{ __('front.your_rating') }}:</p>
                            <div class="rating" id="star-rating">
                                <i class="fa-solid fa-star" data-value="1"></i>
                                <i class="fa-solid fa-star" data-value="2"></i>
                                <i class="fa-solid fa-star" data-value="3"></i>
                                <i class="fa-solid fa-star" data-value="4"></i>
                                <i class="fa-solid fa-star" data-value="5"></i>
                            </div>
                        </div>
                        <div class="yourRating mt40">
                            <p>{{ __('front.your_review') }}:</p>
                        </div>
                        <div class="form w550 mt20">
                            <div class="input">
                                <span>{{ __('front.write_review') }}:</span>
                                <textarea name="comment" placeholder="{{ __('front.write_review') }}" required></textarea>
                            </div>
                            <button type="submit" class="store mt20">{{ __('front.submit') }}</button>
                        </div>
                    </form>
                @else
                    <div class="login-to-review">
                        <p>{{ __('front.login_to_review') }}</p>
                        <a href="{{ route('front.login') }}" class="store">{{ __('front.sign_in') }}</a>
                    </div>
                @endauth
            </div>
            <!-- End Reviews -->
        </div>
    </div>

    <!-- Related Products -->
    @if ($relatedProducts->count() > 0)
        <div class="bgfff pb50">
            <div class="h1">
                <h1>{{ __('front.related_products') }}</h1>
            </div>
            <div class="box pt0">
                <a href="{{ route('front.shop.index', ['categories' => [$product->category_id]]) }}"
                    class="store moreBtn mb10">
                    {{ __('front.view_all') }}
                </a>
                <div class="swiper imagesSlider2" id="imagesSlider">
                    <div class="swiper-wrapper">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="swiper-slide">
                                <div class="prod">
                                    <div class="addToFav" tabindex="0" data-product-id="{{ $relatedProduct->id }}">
                                        <i class="fa-light fa-heart"></i>
                                    </div>
                                    <a href="{{ route('front.products.show', $relatedProduct->slug) }}"
                                        class="prodImage">
                                        <img src="{{ $relatedProduct->getFirstMediaUrl('products') ?: asset('front/media/placeholder.png') }}"
                                            alt="{{ $relatedProduct->name }}">
                                    </a>
                                    <div class="nAndr">
                                        <h2>{{ $relatedProduct->name }}</h2>
                                        <div class="rate">
                                            @php
                                                $relatedRating = round($relatedProduct->reviews->avg('rating') ?? 0);
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $relatedRating)
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-light fa-star"></i>
                                                @endif
                                            @endfor
                                            <span>({{ $relatedProduct->reviews->count() }})</span>
                                        </div>
                                    </div>
                                    <div class="price">
                                        @if ($relatedProduct->discount_price && $relatedProduct->discount_price < $relatedProduct->price)
                                            <span>{{ number_format($relatedProduct->discount_price, 2) }}
                                                {{ __('front.currency') }}</span>
                                            <del>{{ number_format($relatedProduct->price, 2) }}
                                                {{ __('front.currency') }}</del>
                                        @else
                                            <span>{{ number_format($relatedProduct->price, 2) }}
                                                {{ __('front.currency') }}</span>
                                        @endif
                                    </div>
                                    <div class="btns">
                                        <button type="button"
                                            onclick="AddToCart({{ json_encode([
                                                'id' => $relatedProduct->id,
                                                'name' => $relatedProduct->name,
                                                'price' => $relatedProduct->discount_price ?? $relatedProduct->price,
                                                'image' => $relatedProduct->getFirstMediaUrl('products'),
                                            ]) }})">
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
    @endif
@endsection

@section('scripts')
    <script>
        // Tab switching
        function showTab(tabId, button) {
            document.getElementById('details').style.display = tabId === 'details' ? 'block' : 'none';
            document.getElementById('reviews').style.display = tabId === 'reviews' ? 'block' : 'none';
            document.querySelectorAll('.secs button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        }

        // Quantity controls
        function incrementQty() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max) || 999;
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Star rating
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('#star-rating i');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.dataset.value;
                    ratingInput.value = value;

                    stars.forEach((s, index) => {
                        if (index < value) {
                            s.classList.remove('fa-light');
                            s.classList.add('fa-solid');
                        } else {
                            s.classList.remove('fa-solid');
                            s.classList.add('fa-light');
                        }
                    });
                });

                star.addEventListener('mouseenter', function() {
                    const value = this.dataset.value;
                    stars.forEach((s, index) => {
                        if (index < value) {
                            s.classList.remove('fa-light');
                            s.classList.add('fa-solid');
                        } else {
                            s.classList.remove('fa-solid');
                            s.classList.add('fa-light');
                        }
                    });
                });
            });

            document.getElementById('star-rating').addEventListener('mouseleave', function() {
                const currentRating = ratingInput.value;
                stars.forEach((s, index) => {
                    if (index < currentRating) {
                        s.classList.remove('fa-light');
                        s.classList.add('fa-solid');
                    } else {
                        s.classList.remove('fa-solid');
                        s.classList.add('fa-light');
                    }
                });
            });
        });
    </script>
@endsection
