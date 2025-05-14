<!-- Admin Sidebar -->
<div class="sidebar bg-dark text-white" id="sidebar">
    <div class="sidebar-header p-3 border-bottom border-secondary">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                <h5 class="mb-0 text-white d-flex align-items-center">
                    <i class="fas fa-heartbeat text-primary me-2"></i>
                    <span>HealthCare</span>
                </h5>
            </a>
            <button class="btn btn-link text-white d-lg-none" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <div class="sidebar-user p-3 border-bottom border-secondary">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <img src="{{ auth()->user()->profile_photo_url ?? '/images/default-avatar.png' }}" 
                     alt="Admin" class="rounded-circle" width="40" height="40">
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
                <small class="text-muted">Administrator</small>
            </div>
        </div>
    </div>
    
    <ul class="nav flex-column p-3">
        <li class="nav-item mb-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        
        <li class="nav-item mb-3">
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-2 mt-4 mb-2">
                <span class="text-muted text-uppercase small">User Management</span>
            </span>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Users
            </a>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}">
                <i class="fas fa-user-md me-2"></i> Doctors
            </a>
        </li>
        
        <li class="nav-item mb-3">
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-2 mt-4 mb-2">
                <span class="text-muted text-uppercase small">Pharmacy</span>
            </span>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="fas fa-th-list me-2"></i> Categories
            </a>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <i class="fas fa-pills me-2"></i> Products
            </a>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart me-2"></i> Orders
            </a>
        </li>
        
        <li class="nav-item mb-3">
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-2 mt-4 mb-2">
                <span class="text-muted text-uppercase small">Appointments</span>
            </span>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.appointments.index') }}" class="nav-link {{ request()->routeIs('admin.appointments*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check me-2"></i> Appointments
            </a>
        </li>
        
        <li class="nav-item mb-3">
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-2 mt-4 mb-2">
                <span class="text-muted text-uppercase small">Configuration</span>
            </span>
        </li>
        
        <li class="nav-item mb-1">
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fas fa-cog me-2"></i> Settings
            </a>
        </li>
    </ul>
</div>

<style>
.sidebar {
    width: 260px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
    overflow-y: auto;
    transition: all 0.3s;
}

.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: #343a40;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #495057;
    border-radius: 20px;
}

.sidebar-header {
    background-color: #212529;
}

.sidebar .nav-link {
    color: #adb5bd;
    border-radius: 5px;
    transition: all 0.3s;
    padding: 0.75rem 1rem;
}

.sidebar .nav-link:hover {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
}

.sidebar .nav-link.active {
    color: #fff;
    background-color: var(--bs-primary);
}

.sidebar-heading {
    font-size: 0.75rem;
    font-weight: 600;
}

@media (max-width: 992px) {
    .sidebar {
        transform: translateX(-100%);
    }
    
    .sidebar.show {
        transform: translateX(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    document.getElementById('toggleSidebar')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('show');
    });
    
    document.getElementById('closeSidebar')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('show');
    });
});
</script> 