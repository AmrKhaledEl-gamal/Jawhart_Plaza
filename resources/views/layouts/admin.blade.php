<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    @stack('styles')
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <div id="main-content">
            <!-- Top Navbar -->
            @include('layouts.partials.navbar')

            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
