@extends('front.layouts.app')

@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/signup.png') }}" alt="">
        <div class="box ktx z2">
            <h1 class="tru">
                {{ __('front.register_welcome') }}
            </h1>
            <p>{{ __('front.register_subtitle') }}</p>
        </div>
    </div>

    <div class="contactPage">
        <div class="box contact">
            <div class="formcontrol">
                <h2>{{ __('front.sign_up') }}</h2>

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

                <form class="form" method="POST" action="{{ route('front.register') }}">
                    @csrf
                    <div class="input">
                        <span>{{ __('front.username') }}:</span>
                        <input type="text" name="name" placeholder="{{ __('front.username') }}"
                            value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input">
                        <span>{{ __('front.email_address') }}:</span>
                        <input type="email" name="email" placeholder="{{ __('front.email_address') }}"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="inputs">
                        <div class="input">
                            <span>{{ __('front.password') }}:</span>
                            <div class="select">
                                <input type="password" name="password" id="password"
                                    placeholder="{{ __('front.password') }}" required>
                                <i class="fa-light fa-eye-slash" id="passwordShow"
                                    onclick="togglePassword('password', 'passwordShow')"></i>
                            </div>
                            @error('password')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input">
                            <span>{{ __('front.confirm_password') }}:</span>
                            <div class="select">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="{{ __('front.confirm_password') }}" required>
                                <i class="fa-light fa-eye-slash" id="passwordConfirmShow"
                                    onclick="togglePassword('password_confirmation', 'passwordConfirmShow')"></i>
                            </div>
                        </div>
                    </div>

                    <div class="forgot">
                        {{ __('front.have_account') }} <a href="{{ route('front.login') }}">{{ __('front.sign_in') }}</a>
                    </div>
                    <button type="submit" class="store mla">{{ __('front.sign_up') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

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
