<!-- Pharma-Style Navigation for Home and Doctors pages -->
<style>
    :root {
        --primary-color: #3a86ff;
        --secondary-color: #8ecae6;
        --accent-color: #219ebc;
        --light-color: #f1faee;
        --dark-color: #023047;
        --success-color: #2ec4b6;
        --danger-color: #e71d36;
        --warning-color: #ff9f1c;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: var(--dark-color);
    }
    
    .navbar {
        background-color: white !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1) !important;
    }
    
    .navbar.sticky-top {
        position: sticky;
        top: 0;
        z-index: 1030;
        transition: all 0.3s ease;
    }
    
    .navbar .nav-link {
        color: var(--dark-color) !important;
        font-weight: 500;
        padding: 0.7rem 1.2rem !important;
        transition: all 0.3s ease;
    }
    
    .navbar .nav-link:hover {
        color: var(--primary-color) !important;
    }
    
    .navbar .nav-link.active {
        color: var(--primary-color) !important;
        font-weight: 600;
    }
    
    .navbar .badge {
        position: relative;
        top: -5px;
        font-size: 0.7rem;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/images/logo.png" height="40" alt="HealthCare">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctors') ? 'active' : '' }}" href="{{ route('doctors') }}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pharma.index') ? 'active' : '' }}" href="{{ route('pharma.index') }}">Pharmacy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i> Cart 
                        <span class="badge bg-danger rounded-pill cart-count">{{ count(session('cart', [])) }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('order.items') ? 'active' : '' }}" href="{{ route('order.items') }}">
                        <i class="fas fa-clipboard-list"></i> Orders
                    </a>
                </li>
                
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endguest
                
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Add Bootstrap 5 scripts for dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 