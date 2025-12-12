@extends('front.layouts.app')
@section('content')
    <main class ="innerPage">
        <header>
            <span class="heroOverlay"><img src="{{ asset('front/images/innerPageBanner.png') }}" alt="banner"></span>
            <h1 class="intro underline" data-aos="zoom-in-up">تواصل معنا </h1>
        </header>



        <section class="contact" id="contact">
            <h2 class="intro underline" data-aos="fade-up">تواصل معنا بكل سهولة</h2>
            <div class="container">
                <form action="{{ route('front.contact.store') }}" method="POST" data-aos="fade-left">
                    @csrf

                    <div class="inputHolder">
                        <label for="full_name">الأسم الكامل :</label>
                        <input type="text" id="full_name" name="full_name" autocomplete="name" placeholder="الأسم الكامل"
                            required />
                    </div>

                    <div class="inputHolder">
                        <label for="email">البريد الالكتروني :</label>
                        <input type="email" id="email" name="email" autocomplete="email"
                            placeholder="البريد الالكتروني" required />
                    </div>

                    <div class="inputHolder">
                        <label for="phone_number">رقم الهاتف :</label>
                        <input type="tel" id="phone_number" name="phone_number" autocomplete="cc-number"
                            placeholder="رقم الهاتف" required />
                    </div>

                    <div class="inputHolder">
                        <label for="message">محتوى الرسالة :</label>
                        <textarea name="message" id="message" placeholder="الرسالة" required></textarea>
                    </div>

                    <button type="submit" class="readMore">
                        ارسال
                    </button>
                </form>


                <div class="contactInfo" data-aos="fade-right" data-aos-delay="300">
                    <h3>معلومات التواصل :</h3>
                    <article>
                        <a href="tel:{{ $settings->phone_number }}" class="contactHandle">
                            <span class="contactIcon">
                                <i class="fa-solid fa-phone-volume"></i>
                            </span> تواصل عبر الهاتف
                        </a>
                        <a href="{{ $settings->whatsapp }}" class="contactHandle">
                            <span class="contactIcon">
                                <i class="fa-brands fa-whatsapp"></i>
                            </span> تواصل عبر الواتساب
                        </a>
                        <a href="mailto:{{ $settings->email }}" class="contactHandle">
                            <span class="contactIcon">
                                <i class="fa-solid fa-envelope"></i>
                            </span> البريد الالكتروني : {{ $settings->email }}
                        </a>


                    </article>
                </div>
            </div>
        </section>
    @endsection
    @section('js')
        <script defer>
            const telInput = document.getElementById("phone_number");

            // Block non-numeric keypress
            telInput.addEventListener("keypress", (e) => {
                if (!/[0-9]/.test(e.key)) e.preventDefault();
            });

            // Clean pasted text or mobile input
            telInput.addEventListener("input", () => {
                telInput.value = telInput.value.replace(/\D/g, "");
            });
        </script>
    @endsection
