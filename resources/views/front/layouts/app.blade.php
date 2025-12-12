<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>مطاحن ومحامص الضيـاء - منذ 1997</title>
    <link rel="icon" type="image/png" href="{{ asset('front/images/diaaTitle.svg') }}" />

    <link rel="icon" href="{{ asset('storage/' . ($settings->site_favicon ?? 'default-favicon.png')) }}"
        type="image/x-icon" />

    <!-- SEO -->
    <meta name="description" content="{{ $settings->site_meta_description }}" />

    <meta name="keywords" content="{{ $settings->site_meta_keywords }}" />

    <meta name="author" content="{{ $settings->site_meta_author }}" />

    <!-- OG -->
    <meta property="og:title" content="مطاحن ومحامص الضياء - منذ 1997" />
    <meta property="og:description"
        content="منذ عام 1997 ومطاحن ومحامص الضياء تقدم أجود أنواع القهوة، الزعتر، البهارات، الأعشاب، المكسرات والمزيد." />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ar_AR" />
    <meta property="og:url" content="https://aldhiaa.com" />
    <meta property="og:image" content="https://aldhiaa.com/assets/aldhiaa-cover.jpg" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="مطاحن ومحامص الضياء - منذ 1997" />
    <meta name="twitter:description" content="أجود منتجات القهوة والزعتر والبهارات والمكسرات منذ أكثر من 25 عامًا." />
    <meta name="twitter:image" content="https://aldhiaa.com/assets/aldhiaa-cover.jpg" />

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
</head>


<body>

    @include('front.layouts.nav')




    @yield('content')

    <footer>
        <div class="container">
            <article data-aos="fade-up">
                <img src="{{ asset('storage/' . ($settings->site_favicon ?? 'default-favicon.png')) }}"
                    alt="Logo" />
                <h2> تعرف على منتجاتنا !</h2>
                <button type="button" class="contact">
                    <a href="{{ asset('front/catalog.pdf') }}" download>

                        تحميل الكاتلوج
                    </a>
                </button>
            </article>
            <article data-aos="fade-up" data-aos-delay="200">
                <h3>تواصل معنا</h3>
                <ul>

                    <li>
                        <a href="tel:+{{ $settings->phone_number }}">
                            <span class="contactIcon"><i class="fa-solid fa-phone-volume"></i>
                            </span> للتواصل : {{ $settings->phone_number }}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="contactIcon"><i class="fa-solid fa-location-dot"></i>
                            </span> الاردن - عمان
                        </a>
                    </li>

                    <li>
                        <a href="mailto:{{ $settings->email }}">
                            <span class="contactIcon">
                                <i class="fa-solid fa-envelope"></i>
                            </span> {{ $settings->email }}
                        </a>
                    </li>
                    <li class="socials">
                        <a href="{{ $settings->whatsapp }} " class="contactIcon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="{{ $settings->instagram }}" class="contactIcon">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="{{ $settings->facebook }}" class="contactIcon">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                </ul>
            </article>
            <article data-aos="fade-up" data-aos-delay="300">
                <h3> فروعنــــا</h3>
                <ul>

                    <li>
                        <a href="tel:+078888888">
                            <span class="contactIcon"><i class="fa-solid fa-phone-volume"></i>
                            </span>فرع عمان - 078888888
                        </a>
                    </li>
                    <li>
                        <a href="tel:+078888888">
                            <span class="contactIcon"><i class="fa-solid fa-phone-volume"></i>
                            </span>فرع عمان - 078888888
                        </a>
                    </li>
                    <li>
                        <a href="tel:+078888888">
                            <span class="contactIcon"><i class="fa-solid fa-phone-volume"></i>
                            </span> فرع عمان - 078888888
                        </a>
                    </li>
                </ul>
            </article>
        </div>
    </footer>
    </main>
</body>

<!-- 1. Third-party libraries (that don’t depend on your code) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- 2. Lenis (module must come before your script if you use it inside) -->
<script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.27/bundled/lenis.min.js"></script>
<script>
    const lenis = new Lenis({
        duration: 1.5, // close to native (default ~0.4–0.5)
        smooth: true,
        lerp: 0.5, // very small easing factor (0.05–0.1 is subtle)
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);
</script>
<!-- 3. Your own scripts (that depend on libs being loaded) -->
<script src="{{ asset('front/js/swiper.js') }}"></script>
<script src="{{ asset('front/js/script.js') }}" defer></script>
{{-- <script src="{{ asset('front/js/productsFilter.js') }}" defer></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- 4. Init AOS after everything -->
<script>
    AOS.init({
        duration: 1000,
        once: false,
    });
</script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "نجاح!",
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "خطأ!",
            text: "{{ session('error') }}",
            timer: 2500,
            showConfirmButton: false
        });
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "تنبيه!",
            text: "{{ session('warning') }}",
            showConfirmButton: true
        });
    </script>
@endif
@if ($errors->any())
    <script>
        let errorMessages = `
            <ul style="text-align: right; direction: rtl;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;

        Swal.fire({
            icon: "error",
            title: "يوجد بعض الأخطاء!",
            html: errorMessages,
            confirmButtonText: "حسناً"
        });
    </script>
@endif
<script>
    const menuBtn = document.getElementById('menu');
    const navDropdown = document.getElementById('navigation_dropdown');

    menuBtn.addEventListener('click', () => {
        // toggle class 'active' أو 'show' عشان يظهر / يختفي
        navDropdown.classList.toggle('show');
    });
</script>
@yield('js')

</html>
