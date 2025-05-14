<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HealthCare') }} - @yield('title', 'Welcome')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}">
                            <img src="/images/logo.png" alt="HealthCare" class="img-fluid" style="max-width: 220px;">
                        </a>
                    </div>
                    
                    <!-- Auth Card -->
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                        @if(isset($header))
                            <div class="card-header bg-primary text-white py-3">
                                <h4 class="mb-0 text-center">{{ $header }}</h4>
                            </div>
                        @endif
                        
                        <div class="card-body p-4 p-sm-5">
                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success mb-4" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <!-- Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- Form Content -->
                            {{ $slot }}
                        </div>
                    </div>
                    
                    <!-- Additional Links -->
                    <div class="text-center mt-4">
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('home') }}" class="text-decoration-none text-muted">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                            <a href="{{ route('contact') }}" class="text-decoration-none text-muted">
                                <i class="fas fa-envelope me-1"></i> Contact
                            </a>
                            <a href="{{ route('pharma.index') }}" class="text-decoration-none text-muted">
                                <i class="fas fa-pills me-1"></i> Pharmacy
                            </a>
                        </div>
                        <p class="mt-3 mb-0 text-muted small">
                            &copy; {{ date('Y') }} HealthCare. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>

<style>
body {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    background-attachment: fixed;
}

.card {
    transition: all 0.3s ease;
    border-radius: 0.5rem;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.card-header {
    border-bottom: none;
}

.form-control:focus, 
.form-select:focus, 
.form-check-input:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn-primary {
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}
</style> 