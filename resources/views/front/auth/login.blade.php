@extends('front.layouts.app')

@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/login.png') }}" alt="">
        <div class="box ktx z2">
            <h1 class="tru">
                {{ __('front.login_welcome') }}
            </h1>
        </div>
    </div>

    <div class="contactPage">
        <div class="box contact">
            <div class="formcontrol">
                <h2>{{ __('front.sign_in') }}</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form class="form" method="POST" action="{{ route('front.login') }}">
                    @csrf
                    <div class="input">
                        <span>{{ __('front.email') }}:</span>
                        <input type="email" name="email" placeholder="{{ __('front.email') }}"
                            value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="input">
                        <span>{{ __('front.password') }}:</span>
                        <div class="select">
                            <input type="password" name="password" id="password" placeholder="{{ __('front.password') }}"
                                required>
                            <i class="fa-light fa-eye-slash" id="passwordShow" onclick="togglePassword()"></i>
                        </div>
                    </div>
                    <div class="labelinput mb-3">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">{{ __('front.remember_me') }}</label>
                    </div>
                    <div class="forgot">
                        {{ __('front.no_account') }} <a
                            href="{{ route('front.register') }}">{{ __('front.sign_up') }}</a>
                    </div>
                    <button type="submit" class="store mla">{{ __('front.sign_in') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('passwordShow');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
@endsection
