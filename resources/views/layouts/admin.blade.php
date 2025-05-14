<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HealthCare') }} Admin - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Admin Stylesheet -->
    <link rel="stylesheet" href="/css/admin.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-light">
    <div class="admin-layout">
        <!-- Admin Sidebar -->
        @include('layouts.components.sidebar')
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Admin Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2 px-3">
                <div class="container-fluid px-0">
                    <!-- Mobile Toggle Button for Sidebar -->
                    <button class="btn btn-outline-secondary border-0 d-lg-none me-3" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <span class="navbar-brand d-none d-sm-block">@yield('title', 'Dashboard')</span>
                    
                    <!-- Right-aligned Items -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Notifications Dropdown -->
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end py-0 overflow-hidden" aria-labelledby="notificationsDropdown" style="width: 320px;">
                                <li class="dropdown-header bg-light py-2 px-3 border-bottom">
                                    <span class="fw-medium">Notifications</span>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3 border-bottom" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-shopping-cart text-primary rounded-circle p-2 bg-light"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-0 fw-medium">New order received</p>
                                                <small class="text-muted">30 minutes ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3 border-bottom" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-user-plus text-success rounded-circle p-2 bg-light"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-0 fw-medium">New user registered</p>
                                                <small class="text-muted">2 hours ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-calendar-check text-warning rounded-circle p-2 bg-light"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-0 fw-medium">New appointment booked</p>
                                                <small class="text-muted">1 day ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 text-center bg-light" href="#">
                                        View all notifications
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user()->profile_photo_url ?? '/images/default-avatar.png' }}" 
                                     alt="Admin" class="rounded-circle" width="32" height="32">
                                <span class="d-none d-lg-inline-block ms-1">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-circle me-2"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                        <i class="fas fa-cog me-2"></i> Settings
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <a class="dropdown-item" href="#" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Page Content -->
            <div class="container-fluid p-4">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <!-- Main Content -->
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom Admin Scripts -->
    <script src="/js/admin.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('toggleSidebar')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
        });
    </script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>

<style>
/* Admin Layout */
.admin-layout {
    display: flex;
}

.main-content {
    flex: 1;
    margin-left: 260px;
    min-height: 100vh;
    transition: all 0.3s;
}

@media (max-width: 992px) {
    .main-content {
        margin-left: 0;
    }
}
</style> 