@extends('front.layouts.app')
@section('content')
    <main class="innerPage">
        <header>
            <span class="heroOverlay"><img src="{{ asset('front/images/innerPageBanner.png') }}" alt="banner"></span>
            <h1 class="intro underline" data-aos="zoom-in-up">من نحن</h1>
        </header>


        <section class="whoWe">

            <div class="container">
                <article class="whoWeImg" data-aos="fade-left">
                    <img src="{{ $about->getFirstMediaUrl('about_images') ?: '' }}" alt="who we" />
                </article>
                <article class="heroIntro" data-aos="fade-right" data-aos-delay="300">
                    <h2>مطاحن ومحامص الضياء </h2>

                    {!! $about->about !!}

                    <button type="button" class="contact">


                    </button>
                </article>
            </div>
        </section>


        <section class="ourVision">
            <div class="container">
                <article>


                    <h2 class="intro underline" data-aos="fade-up">رؤيتنــــا</h2>

                    {!! $about->vision !!}

                </article>
            </div>
        </section>

        <section class="ourMission">
            <h2 class="intro underline" data-aos="fade-up">قيمنــــا</h2>
            <div class="container">
                <article>
                    <h2>الجودة أولاً</h2>
                    <p>نلتزم بتقديم منتجات بمعايير عالية في كل مرحلة من مراحل الإنتاج.</p>
                </article>
                <article>
                    <h2>
                        الشفافية والثقة
                    </h2>
                    <p>نبني علاقتنا مع عملائنا على الصدق والمصداقية في كل تعامل.</p>
                </article>
                <article>
                    <h2>
                        الطزاجة والنكهة
                    </h2>
                    <p>نحرص على أن تصل منتجاتنا دائمًا بأفضل جودة ونكهة.</p>
                </article>
                <article class="longerGrid">
                    <h2>
                        التميز في الخدمة
                    </h2>
                    <p>نضع رضا عملائنا في مقدمة أولوياتنا، ونسعى لتجربة شراء تفوق التوقعات.</p>
                </article>
                <article class="longerGrid">
                    <h2>
                        الاستمرارية والتطوير
                    </h2>
                    <p>نؤمن أن النجاح لا يتحقق إلا بالتجدد والابتكار المستمر.</p>
                </article>
            </div>
        </section>
    @endsection
