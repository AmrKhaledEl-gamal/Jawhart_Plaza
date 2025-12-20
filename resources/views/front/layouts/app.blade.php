<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $locale = app()->getLocale();
        $siteName = $settings->site_name ?? config('app.name');
        if (is_array($siteName)) {
            $siteName = $siteName[$locale] ?? ($siteName['en'] ?? reset($siteName));
        }
        $metaDesc = $settings->site_meta_description ?? '';
        if (is_array($metaDesc)) {
            $metaDesc = $metaDesc[$locale] ?? ($metaDesc['en'] ?? reset($metaDesc));
        }
        $faviconPath = $settings->site_favicon ?? null;
    @endphp

    <link rel="icon" href="{{ $faviconPath ? asset('storage/' . $faviconPath) : asset('front/media/tap-icon.svg') }}"
        type="image/x-icon" />
    <link rel="shortcut icon"
        href="{{ $faviconPath ? asset('storage/' . $faviconPath) : asset('front/media/tap-icon.svg') }}" />
    <link rel="apple-touch-icon"
        href="{{ $faviconPath ? asset('storage/' . $faviconPath) : asset('front/media/tap-icon.svg') }}" />
    <meta name="color-scheme" content="light only">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('front/js/swiper-bundle.min.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('front/arscss/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('front/enscss/style.css') }}">
    @endif
    <title>{{ $siteName }}</title>
    @if (!empty($metaDesc))
        <meta name="description" content="{{ $metaDesc }}">
    @endif
</head>

<body>

    <!-- Start Cart Sidebar -->
    @auth
        @php
            $sidebarCartItems = \App\Models\Cart::with(['product.media', 'variant.size', 'variant.color'])
                ->where('user_id', auth()->id())
                ->take(5)
                ->get();
            $sidebarTotal = $sidebarCartItems->sum(function ($item) {
                $price = $item->product->discount_price ?? $item->product->price;
                return $price * $item->quantity;
            });
        @endphp
        <div class="cartInner">
            <div class="cartBody">
                <h2>{{ __('front.order_summary') }}: <i class="fa-light fa-backward-fast"></i></h2>
                <div class="itemsIncart">
                    @forelse($sidebarCartItems as $cartItem)
                        <div class="itDcart">
                            <img src="{{ $cartItem->product->getFirstMediaUrl('products') ?: asset('front/media/placeholder.png') }}"
                                alt="{{ $cartItem->product->name }}">
                            <div class="itdd">
                                <h3>{{ Str::limit($cartItem->product->name, 20) }}</h3>
                                <span>{{ number_format($cartItem->product->discount_price ?? $cartItem->product->price, 2) }}
                                    {{ __('front.currency') }}</span>
                                @if ($cartItem->variant)
                                    <small>
                                        @if ($cartItem->variant->size)
                                            {{ $cartItem->variant->size->name }}
                                        @endif
                                        @if ($cartItem->variant->color)
                                            - {{ $cartItem->variant->color->name }}
                                        @endif
                                        x{{ $cartItem->quantity }}
                                    </small>
                                @endif
                            </div>
                            <form action="{{ route('front.cart.destroy', $cartItem) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-cart-sidebar">
                            <p>{{ __('front.cart_empty') }}</p>
                        </div>
                    @endforelse
                </div>
                <div class="total">
                    <span>{{ __('front.total') }}:</span>
                    <span>{{ number_format($sidebarTotal, 2) }} {{ __('front.currency') }}</span>
                </div>
                <div class="btns btns3">
                    <a href="#">{{ __('front.proceed_to_payment') }}</a>
                    <a href="{{ route('front.cart') }}">{{ __('front.view_cart') }}</a>
                </div>
            </div>
        </div>
    @else
        <div class="cartInner">
            <div class="cartBody">
                <h2>{{ __('front.order_summary') }}: <i class="fa-light fa-backward-fast"></i></h2>
                <div class="itemsIncart">
                    <div class="empty-cart-sidebar">
                        <p>{{ __('front.login_to_view_cart') }}</p>
                        <a href="{{ route('front.login') }}" class="store">{{ __('front.sign_in') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    <!-- End Cart Sidebar -->



    <!-- Start Nav -->
    @include('front.layouts.nav')

    @yield('content')


    <footer>
        <div class="box footer">
            @php
                $logoPath = $settings->site_logo ?? null;
            @endphp
            <div class="footerLogo">
                <img src="{{ $logoPath ? asset('storage/' . $logoPath) : asset('front/media/logo.png') }}"
                    alt="logo">
                <div class="aboutText colorfff">
                    <p>{{ $metaDesc }}</p>
                </div>
                <div class="media">
                    @if (!empty($settings->facebook))
                        <a href="{{ $settings->facebook }}" target="_blank" rel="noopener"><i
                                class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if (!empty($settings->instagram))
                        <a href="{{ $settings->instagram }}" target="_blank" rel="noopener"><i
                                class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if (!empty($settings->whatsapp))
                        <a href="{{ $settings->whatsapp }}" target="_blank" rel="noopener"><i
                                class="fa-brands fa-whatsapp"></i></a>
                    @endif
                </div>
            </div>
            <div class="footerLinkGroup">
                <div class="linkGroup">
                    <h2>helpful link</h2>
                    <ul>
                        <li><a href="./index.html"><img src="{{ asset('front/media/icons/footerLink.svg') }}"
                                    alt=""> Home </a>
                        </li>
                        <li><a href="{{ route('front.about') }}"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt=""> About
                                Us </a></li>
                        <li><a href="{{ route('front.shop.index') }}"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt="">
                                shop</a></li>
                        <li><a href="{{ route('front.contact.index') }}"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt="">
                                contact us </a></li>
                    </ul>
                </div>
                <div class="linkGroup">
                    <h2>Customer Area</h2>
                    <ul>
                        <li><a href="./enpages/faq.html"><img src="{{ asset('front/media/icons/footerLink.svg') }}"
                                    alt=""> FAQs
                            </a></li>
                        <li><a href="./enpages/buying-guide.html"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt=""> Buying Guide
                            </a>
                        </li>
                        <li><a href="./enpages/delivery-information.html"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt=""> Delivery
                                Information</a></li>
                        <li><a href="./enpages/track-my-order.html"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt=""> Track my
                                order
                            </a></li>
                        <li><a href="{{ route('front.wholesale.index') }}"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt="">
                                wholesale </a></li>
                    </ul>
                </div>
                <div class="linkGroup">
                    <h2>store policies</h2>
                    <ul>
                        <li><a href="./enpages/privacy-policy.html"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt=""> privacy &
                                policy
                            </a></li>
                        <li><a href="./enpages/terms-conditions.html"><img
                                    src="{{ asset('front/media/icons/footerLink.svg') }}" alt=""> terms &
                                conditions </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <script src="{{ asset('front/js/products.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/swiper.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // Global config
        var isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        var loginUrl = '{{ route('front.login') }}';
        var wishlistToggleUrl = '{{ route('front.wishlist.toggle') }}';
        var csrfToken = '{{ csrf_token() }}';

        // Event delegation for wishlist buttons
        document.addEventListener('click', function(e) {
            var wishlistBtn = e.target.closest('.addToFav');
            if (wishlistBtn) {
                e.preventDefault();
                var productId = wishlistBtn.getAttribute('data-product-id');
                if (productId) {
                    toggleWishlist(productId, wishlistBtn);
                }
            }
        });

        // Wishlist toggle function
        function toggleWishlist(productId, button) {
            if (!isAuthenticated) {
                window.location.href = loginUrl;
                return;
            }

            fetch(wishlistToggleUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.success) {
                        var icon = button.querySelector('i');
                        if (icon) {
                            if (data.inWishlist) {
                                icon.classList.remove('fa-light');
                                icon.classList.add('fa-solid');
                            } else {
                                icon.classList.remove('fa-solid');
                                icon.classList.add('fa-light');
                            }
                        }
                        showNotification(data.message, 'success');
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    showNotification('An error occurred', 'error');
                });
        }

        // Delete from wishlist (for wishlist page)
        function deleteFromWishlist(wishlistId, button) {
            fetch('/wishlist/' + wishlistId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.success) {
                        // Remove the product card from DOM
                        var prodCard = button.closest('.prod');
                        if (prodCard) {
                            prodCard.style.transition = 'opacity 0.3s, transform 0.3s';
                            prodCard.style.opacity = '0';
                            prodCard.style.transform = 'scale(0.8)';
                            setTimeout(function() {
                                prodCard.remove();
                                // Check if wishlist is empty
                                var remaining = document.querySelectorAll('.projects .prod');
                                if (remaining.length === 0) {
                                    location.reload();
                                }
                            }, 300);
                        }
                        showNotification(data.message || 'Removed from wishlist', 'success');
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    showNotification('An error occurred', 'error');
                });
        }

        // Toast notification
        function showNotification(message, type) {
            var existing = document.querySelector('.toast-notification');
            if (existing) existing.remove();

            var notification = document.createElement('div');
            notification.className = 'toast-notification ' + type;
            notification.innerHTML = '<span>' + message +
                '</span><button onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(notification);

            setTimeout(function() {
                notification.remove();
            }, 3000);
        }
    </script>

    <style>
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 20px;
            background: #333;
            color: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .toast-notification.success {
            background: #27ae60;
        }

        .toast-notification.error {
            background: #e74c3c;
        }

        .toast-notification button {
            background: none;
            border: none;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .addToFav {
            cursor: pointer;
        }

        .addToFav i.fa-solid {
            color: #e74c3c;
        }

        /* Wishlist delete button styling */
        .wishlist-delete-form {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .wishlist-delete-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .wishlist-delete-btn:hover {
            background: #e74c3c;
            border-color: #e74c3c;
            color: #fff;
        }

        .wishlist-delete-btn i {
            font-size: 14px;
            color: #666;
        }

        .wishlist-delete-btn:hover i {
            color: #fff;
        }

        /* Empty cart sidebar styling */
        .empty-cart-sidebar {
            text-align: center;
            padding: 40px 20px;
            color: #888;
            width: 100%;
        }

        .empty-cart-sidebar .store {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 25px;
            background: #9f7d51;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
        }

        .remove-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            transition: color 0.2s;
        }

        .remove-btn:hover {
            color: #e74c3c;
        }
    </style>
    @yield('scripts')
</body>

</html>
