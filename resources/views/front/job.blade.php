    @extends('front.layouts.app')
    @section('content')
        <main class ="innerPage">

            <header>
                <span class="heroOverlay"><img src="{{ asset('front/images/innerPageBanner.png') }}" alt="banner"></span>
                <h1 class="intro underline" data-aos="zoom-in-up">التوظيف </h1>
            </header>



            <section class="contact" id="contact">
                <div class="container">
                    <form action="{{ route('front.job.store') }}" method="POST" data-aos="fade-left">
                        @csrf

                        <div class="inputHolder">
                            <label for="name">الأسم الكامل :</label>
                            <input type="text" id="name" name="name" autocomplete="name"
                                placeholder="الأسم الكامل" />
                        </div>

                        <div class="inputHolder">
                            <label for="phone">رقم الهاتف :</label>
                            <input type="tel" id="phone" name="phone" autocomplete="cc-number"
                                placeholder="رقم الهاتف" />
                        </div>

                        <div class="inputHolder">
                            <label for="email">البريد الالكتروني :</label>
                            <input type="email" id="email" name="email" autocomplete="email"
                                placeholder="البريد الالكتروني" />
                        </div>

                        <div class="inputHolder">
                            <label for="birth_date">تاريخ الميلاد :</label>
                            <input type="text" id="date" name="birth_date" autocomplete="date"
                                placeholder="تاريخ الميلاد" />
                        </div>

                        <div class="inputHolder">
                            <span class="selectArrow"><img src="{{ asset('front/images/arrow.svg') }}"
                                    alt="arrow"></span>
                            <label for="nationality">الجنسية :</label>

                            <select id="nationality" name="nationality" autocomplete="country">
                                <option value="" disabled selected>اختر الجنسية</option>

                                @foreach ($nationalities as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="inputHolder">
                            <span class="selectArrow"><img src="{{ asset('front/images/arrow.svg') }}"
                                    alt="arrow"></span>

                            <label for="job_id">الوظيفة المراد التقديم عليها : :</label>

                            <select id="job_id" name="job_id" autocomplete="country">
                                <option value="" disabled selected>اختر الوظيفة</option>

                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}">{{ $job->name }}</option>
                                @endforeach


                            </select>
                        </div>

                        <button type="submit" class="readMore">
                            ارسال
                        </button>

                    </form>

                    <div class="contactInfo" data-aos="fade-right" data-aos-delay="300">
                        <h3> الوظائف المتاحه :</h3>
                        <article>
                            @foreach ($jobs as $job)
                                <article class="contactHandle">
                                    <svg width="46" height="38" viewBox="0 0 46 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M28.4959 8.54881C27.4472 8.54881 26.5962 7.69773 26.5962 6.64907V3.79947H18.9972V6.64907C18.9972 7.69773 18.1461 8.54881 17.0975 8.54881C16.0488 8.54881 15.1978 7.69773 15.1978 6.64907V3.79947C15.1978 1.70406 16.9018 0 18.9972 0H26.5962C28.6916 0 30.3956 1.70406 30.3956 3.79947V6.64907C30.3956 7.69773 29.5446 8.54881 28.4959 8.54881Z"
                                            fill="white" />
                                        <path
                                            d="M24.1456 25.4203C23.8037 25.5533 23.3097 25.6483 22.7968 25.6483C22.2839 25.6483 21.79 25.5533 21.334 25.3824L0 18.2773V32.7723C0 35.6599 2.33667 37.9966 5.22427 37.9966H40.3694C43.257 37.9966 45.5936 35.6599 45.5936 32.7723V18.2773L24.1456 25.4203Z"
                                            fill="white" />
                                        <path
                                            d="M45.5936 10.9235V15.2739L23.2528 22.7208C23.1008 22.7778 22.9488 22.7968 22.7968 22.7968C22.6448 22.7968 22.4929 22.7778 22.3409 22.7208L0 15.2739V10.9235C0 8.03589 2.33667 5.69922 5.22427 5.69922H40.3694C43.257 5.69922 45.5936 8.03589 45.5936 10.9235Z"
                                            fill="white" />
                                    </svg>
                                    <p>

                                        <span class="jobName">{{ $job->name }} -</span> {{ $job->description }}
                                    </p>
                                </article>
                            @endforeach

                        </article>
                    </div>
                </div>
            </section>
        @endsection

        @section('js')
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script>
                flatpickr("#date", {
                    dateFormat: "Y-m-d"
                });
            </script>

            <script defer>
                const telInput = document.getElementById("phone");

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
