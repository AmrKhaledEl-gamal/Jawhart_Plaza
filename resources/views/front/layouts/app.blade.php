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

    <link rel="icon" href="{{ $faviconPath ? asset('storage/' . $faviconPath) : asset('front/media/tap-icon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ $faviconPath ? asset('storage/' . $faviconPath) : asset('front/media/tap-icon.svg') }}" />
    <link rel="apple-touch-icon" href="{{ $faviconPath ? asset('storage/' . $faviconPath) : asset('front/media/tap-icon.svg') }}" />
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

    <!-- Start Cart -->
    <div class="cartInner">
        <div class="cartBody">
            <h2>Order Summary: <i class="fa-light fa-backward-fast"></i></h2>
            <div class="itemsIncart">
                <div class="itDcart">
                    <img src="{{ asset('front/media/DONE1OUT.png') }}" alt="">
                    <div class="itdd">
                        <h3>Product Name</h3>
                        <span>25JD</span>
                    </div>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
                <div class="itDcart">
                    <img src="{{ asset('front/media/DONE1OUT.png') }}" alt="">
                    <div class="itdd">
                        <h3>Product Name</h3>
                        <span>25JD</span>
                    </div>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
            </div>
            <div class="total">
                <span>Total:</span>
                <span>50JD</span>
            </div>
            <div class="btns btns3">
                <a href="{{ asset('front/enpages/checkout.html') }}">
                    Proceed to Payment
                </a>
                <a href="{{ asset('front/enpages/cart.html') }}">
                    View Cart
                </a>
            </div>
        </div>
    </div>
    <!-- End Cart -->



    <!-- Start Nav -->
    @include('front.layouts.nav')

    @yield('content')


    <footer>
        <div class="box footer">
            @php
                $logoPath = $settings->site_logo ?? null;
            @endphp
            <div class="footerLogo">
                <img src="{{ $logoPath ? asset('storage/' . $logoPath) : asset('front/media/logo.png') }}" alt="logo">
                <div class="aboutText colorfff">
                    <p>{{ $metaDesc }}</p>
                </div>
                <div class="media">
                    @if (!empty($settings->facebook))
                        <a href="{{ $settings->facebook }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if (!empty($settings->instagram))
                        <a href="{{ $settings->instagram }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if (!empty($settings->whatsapp))
                        <a href="{{ $settings->whatsapp }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i></a>
                    @endif
                </div>
            </div>
            <div class="footerLinkGroup">
                <div class="linkGroup">
                    <h2>helpful link</h2>
                    <ul>
                        <li><a href="./index.html"><img src="./media/icons/footerLink.svg" alt=""> Home </a>
                        </li>
                        <li><a href="./enpages/about.html"><img src="./media/icons/footerLink.svg" alt=""> About
                                Us </a></li>
                        <li><a href="./enpages/shop.html"><img src="./media/icons/footerLink.svg" alt="">
                                shop</a></li>
                        <li><a href="./enpages/contact.html"><img src="./media/icons/footerLink.svg" alt="">
                                contact us </a></li>
                    </ul>
                </div>
                <div class="linkGroup">
                    <h2>Customer Area</h2>
                    <ul>
                        <li><a href="./enpages/faq.html"><img src="./media/icons/footerLink.svg" alt=""> FAQs
                            </a></li>
                        <li><a href="./enpages/buying-guide.html"><img src="./media/icons/footerLink.svg"
                                    alt=""> Buying Guide </a>
                        </li>
                        <li><a href="./enpages/delivery-information.html"><img src="./media/icons/footerLink.svg"
                                    alt=""> Delivery
                                Information</a></li>
                        <li><a href="./enpages/track-my-order.html"><img src="./media/icons/footerLink.svg"
                                    alt=""> Track my order
                            </a></li>
                        <li><a href="./enpages/wholesale.html"><img src="./media/icons/footerLink.svg" alt="">
                                wholesale </a></li>
                    </ul>
                </div>
                <div class="linkGroup">
                    <h2>store policies</h2>
                    <ul>
                        <li><a href="./enpages/privacy-policy.html"><img src="./media/icons/footerLink.svg"
                                    alt=""> privacy & policy
                            </a></li>
                        <li><a href="./enpages/terms-conditions.html"><img src="./media/icons/footerLink.svg"
                                    alt=""> terms &
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
    </script>
</body>

</html>
