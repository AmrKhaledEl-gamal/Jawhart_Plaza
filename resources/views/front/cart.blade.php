@extends('front.layouts.app')

@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/wishlist.png') }}" alt="">
        <div class="box ktx z2">
            <h1 class="trc">{{ __('front.my_cart') }}</h1>
        </div>
    </div>

    <!-- Cart table -->
    <div class="cartPage">
        @if (session('success'))
            <div class="box">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="box">
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <div class="scrollTable">
                <div class="box">
                    <table class="tg tg2" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>{{ __('front.products') }}</th>
                                <th>{{ __('front.quantity') }}</th>
                                <th>{{ __('front.total') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr data-cart-id="{{ $item->id }}">
                                    <td>
                                        <div class="prodTable">
                                            <img src="{{ $item->product->getFirstMediaUrl('products') ?: asset('front/media/placeholder.png') }}"
                                                alt="{{ $item->product->name }}">
                                            <div class="prod">
                                                <div class="price">
                                                    @if ($item->product->discount_price && $item->product->discount_price < $item->product->price)
                                                        <span>{{ number_format($item->product->discount_price, 2) }}
                                                            {{ __('front.currency') }}</span>
                                                        <del>{{ number_format($item->product->price, 2) }}
                                                            {{ __('front.currency') }}</del>
                                                    @else
                                                        <span>{{ number_format($item->product->price, 2) }}
                                                            {{ __('front.currency') }}</span>
                                                    @endif
                                                </div>
                                                <div class="nAndr">
                                                    <h2>
                                                        <a href="{{ route('front.products.show', $item->product->slug) }}">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h2>
                                                </div>
                                                @if ($item->variant && $item->variant->size)
                                                    <div class="nAndr">
                                                        <h2>{{ __('front.size') }}:
                                                            <span>{{ $item->variant->size->name }}</span></h2>
                                                    </div>
                                                @endif
                                                @if ($item->variant && $item->variant->color)
                                                    <div class="nAndr">
                                                        <h2>{{ __('front.color') }}: <span class="color"
                                                                style="background-color: {{ $item->variant->color->code }};"></span>
                                                        </h2>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('front.cart.update', $item) }}" method="POST"
                                            class="quantity-form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="count">
                                                <button type="button" onclick="decrementQty(this)">-</button>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" max="{{ $item->variant->stock ?? 99 }}"
                                                    onchange="this.form.submit()">
                                                <button type="button" onclick="incrementQty(this)">+</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        @php
                                            $price = $item->product->discount_price ?? $item->product->price;
                                            $itemTotal = $price * $item->quantity;
                                        @endphp
                                        <b>{{ number_format($itemTotal, 2) }} {{ __('front.currency') }}</b>
                                    </td>
                                    <td>
                                        <form action="{{ route('front.cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                <i class="fa-thin fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="clearandt">
                    <form action="{{ route('front.cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">{{ __('front.clear_cart') }} <i class="fa-regular fa-x"></i></button>
                    </form>
                    <div class="totalp">
                        {{ __('front.order_total') }}:
                        <span>{{ number_format($subtotal, 2) }} {{ __('front.currency') }}</span>
                    </div>
                </div>
            </div>

            <div class="lastBtns">
                <div class="box">
                    <form class="emailInput">
                        <input type="text" name="coupon" placeholder="{{ __('front.coupon_code') }}">
                        <button type="submit">{{ __('front.apply_coupon') }}</button>
                    </form>
                    <a href="#" class="store">{{ __('front.proceed_to_checkout') }}</a>
                </div>
            </div>
        @else
            <div class="box empty-cart">
                <div class="empty-message">
                    <i class="fa-light fa-cart-shopping"></i>
                    <h2>{{ __('front.cart_empty') }}</h2>
                    <p>{{ __('front.cart_empty_message') }}</p>
                    <a href="{{ route('front.shop.index') }}" class="store">{{ __('front.continue_shopping') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function incrementQty(btn) {
            const input = btn.parentElement.querySelector('input');
            const max = parseInt(input.max) || 99;
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
                input.form.submit();
            }
        }

        function decrementQty(btn) {
            const input = btn.parentElement.querySelector('input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                input.form.submit();
            }
        }
    </script>
@endsection
