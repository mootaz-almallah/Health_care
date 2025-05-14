<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- bootstrap.min css -->
        <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
        <!-- Icon Font Css -->
        <link rel="stylesheet" href="/plugins/icofont/icofont.min.css">
        <!-- Slick Slider  CSS -->
        <link rel="stylesheet" href="/plugins/slick-carousel/slick/slick.css">
        <link rel="stylesheet" href="/plugins/slick-carousel/slick/slick-theme.css">

        <!-- Font Awesome for icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
        <link rel="stylesheet" href="/plugins/icofont/icofont.min.css">
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="/css/style.css">

        <!-- Additional Styles -->
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-light">
        <div class="min-h-screen bg-gray-100">
            <!-- Navigation -->
            @include('layouts.components.navbar')

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.components.footer')
        </div>

        <!-- Main jQuery -->
        <script src="/plugins/jquery/jquery.js"></script>
        <!-- Bootstrap 4.3.2 -->
        <script src="/plugins/bootstrap/js/popper.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- Bootstrap 5 (added for new navbar) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/plugins/counterup/jquery.easing.js"></script>
        <!-- Slick Slider -->
        <script src="/plugins/slick-carousel/slick/slick.min.js"></script>
        <!-- Counterup -->
        <script src="/plugins/counterup/jquery.waypoints.min.js"></script>

        <script src="/plugins/shuffle/shuffle.min.js"></script>
        <script src="/plugins/counterup/jquery.counterup.min.js"></script>
        <!-- Google Map -->
        <script src="/plugins/google-map/map.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>

        <script src="/js/script.js"></script>
        <script src="/js/contact.js"></script>
        
        <!-- Additional Scripts -->
        @stack('scripts')
    </body>
</html> 