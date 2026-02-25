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
                                <th>{{ __('front.price') }}</th>
                                <th>{{ __('front.total') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
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
                                                @if ($item->variant)
                                                    @if ($item->variant->size)
                                                        <div class="nAndr">
                                                            <h2>{{ __('front.size') }} :
                                                                <span>{{ $item->variant->size->name }}</span>
                                                            </h2>
                                                        </div>
                                                    @endif
                                                    @if ($item->variant->color)
                                                        <div class="nAndr">
                                                            <h2>{{ __('front.color') }} : <span class="color"
                                                                    style="background-color: {{ $item->variant->color->code }};"></span>
                                                            </h2>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="count" data-cart-id="{{ $item->id }}"
                                            data-update-url="{{ route('front.cart.update', $item) }}"
                                            data-max="{{ $item->variant->stock ?? 99 }}">
                                            <button type="button" class="qty-btn qty-minus">-</button>
                                            <input type="number" class="qty-input" value="{{ $item->quantity }}"
                                                min="1" max="{{ $item->variant->stock ?? 99 }}" readonly>
                                            <button type="button" class="qty-btn qty-plus">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $price = $item->product->discount_price ?? $item->product->price;
                                            $itemTotal = $price * $item->quantity;
                                        @endphp
                                        <b>{{ number_format($price, 2) }} {{ __('front.currency') }}</b>
                                    </td>
                                    <td>
                                        <b class="item-total"
                                            data-cart-id="{{ $item->id }}">{{ number_format($itemTotal, 2) }}
                                            {{ __('front.currency') }}</b>
                                    </td>
                                    <td>
                                        <form action="{{ route('front.cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"
                                                style="background:none; border:none; cursor:pointer; color:inherit;">
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
                        {{ __('front.order_total') }} :
                        <span id="cart-subtotal">{{ number_format($subtotal, 2) }} {{ __('front.currency') }}</span>
                    </div>
                </div>
            </div>

            <div class="lastBtns">
                <div class="box">
                    <form class="emailInput">
                        <input type="text" name="coupon" placeholder="{{ __('front.coupon_code') }}">
                        <button type="submit">{{ __('front.apply_coupon') }}</button>
                    </form>
                    <a href="{{ route('front.checkout.index') }}" class="store">{{ __('front.proceed_to_checkout') }}</a>
                </div>
            </div>
        @else
            <div class="box empty-cart">
                <div class="empty-message">
                    <i class="fa-light fa-cart-shopping" style="font-size: 48px; margin-bottom: 20px;"></i>
                    <h2>{{ __('front.cart_empty') }}</h2>
                    <p>{{ __('front.cart_empty_message') }}</p>
                    <a href="{{ route('front.shop.index') }}" class="store"
                        style="margin-top: 20px; display: inline-block;">{{ __('front.continue_shopping') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const currency = '{{ __('front.currency') }}';

            // Handle quantity buttons
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const container = this.closest('.count');
                    const input = container.querySelector('.qty-input');
                    const cartId = container.dataset.cartId;
                    const updateUrl = container.dataset.updateUrl;
                    const max = parseInt(container.dataset.max) || 99;
                    let currentValue = parseInt(input.value);

                    if (this.classList.contains('qty-plus')) {
                        if (currentValue < max) {
                            currentValue++;
                        } else {
                            return; // At max stock
                        }
                    } else if (this.classList.contains('qty-minus')) {
                        if (currentValue > 1) {
                            currentValue--;
                        } else {
                            return; // Minimum is 1
                        }
                    }

                    // Update display immediately
                    input.value = currentValue;

                    // Show loading state
                    container.classList.add('loading');

                    // Make AJAX request
                    updateQuantity(updateUrl, currentValue, cartId, container);
                });
            });

            function updateQuantity(url, quantity, cartId, container) {
                fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        container.classList.remove('loading');

                        if (data.success) {
                            // Update item total
                            const itemTotalEl = document.querySelector(`.item-total[data-cart-id="${cartId}"]`);
                            if (itemTotalEl) {
                                itemTotalEl.textContent = data.itemTotal + ' ' + currency;
                            }

                            // Update cart subtotal
                            const subtotalEl = document.getElementById('cart-subtotal');
                            if (subtotalEl) {
                                subtotalEl.textContent = data.subtotal + ' ' + currency;
                            }

                            // Update cart count in navbar if exists
                            if (typeof updateCartBadge === 'function') {
                                updateCartBadge();
                            }
                        } else {
                            // Revert on error
                            alert(data.message || 'Error updating cart');
                            location.reload();
                        }
                    })
                    .catch(error => {
                        container.classList.remove('loading');
                        console.error('Error:', error);
                        location.reload();
                    });
            }
        });
    </script>

    <style>
        .count.loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .count.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16px;
            height: 16px;
            border: 2px solid var(--Gold-color);
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .count {
            position: relative;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
@endsection
