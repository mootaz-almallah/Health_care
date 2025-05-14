<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List - E-Pharmacy</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Tajawal (optional, can use Roboto or default) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/css/style.css">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            transition: all 0.3s ease;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar.sticky-top {
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar-nav .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link.active, 
        .navbar-nav .nav-link:hover {
            color: var(--bs-primary);
        }

        .navbar-nav .nav-link.active::after,
        .navbar-nav .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0.75rem;
            left: 0.75rem;
            height: 2px;
            background-color: var(--bs-primary);
            transition: all 0.3s ease;
        }
        
        .pharma-header {
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .pharma-header::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background-color: #0d6efd;
            margin: 0.5rem auto 0;
        }
        
        .search-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .category-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .category-buttons .btn {
            border-radius: 20px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            text-align: left;
        }
        
        .category-buttons .btn.active {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
        }
        
        .medicine-card {
            transition: all 0.3s ease;
            height: 100%;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border: 1px solid #f0f0f0;
            min-width: 160px;
            max-width: 220px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 1.5rem;
        }
        
        .medicine-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .medicine-card .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 10px;
        }
        
        .medicine-card .card-body {
            padding: 0.75rem 0.75rem 0.75rem 0.75rem;
            display: flex;
            flex-direction: column;
            height: 100px;
        }
        
        .medicine-card .card-title {
            font-size: 0.rem;
            margin-bottom: 0.3rem;
            font-weight: 600;
            line-height: 1.2;
            height: 2.2em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .medicine-card .card-text {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 0.3rem;
            height: 1.4em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .medicine-card .price {
            font-size: 1rem;
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .medicine-card .btn-cart {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }
        
        .medicine-card .btn-cart i {
            font-size: 0.85em;
        }
        
        .medicine-card .cart-actions {
            display: flex;
            gap: 0.3rem;
            margin-top: auto;
        }
        
        .medicine-card .btn-add-cart {
            flex-grow: 1;
        }
        
        .medicine-card .btn-remove-cart {
            width: 32px;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .empty-result {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .empty-result i {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        
        .page-header {
            background-color: #0d6efd;
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .page-header::after {
            content: '';
            position: absolute;
            bottom: -70px;
            left: -70px;
            width: 250px;
            height: 250px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .page-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .page-header p {
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .sidebar-panel {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            padding: 24px 18px;
            margin-bottom: 2rem;
            min-height: 300px;
            border-right: 2px solid #e0e0e0;
        }
        @media (max-width: 991.98px) {
            .sidebar-panel {
                border-right: none;
                border-bottom: 2px solid #e0e0e0;
                margin-bottom: 2rem;
            }
        }
        .splitter-col {
            border-right: 2px solid #e0e0e0;
            min-height: 100%;
        }
        
        .medicine-list-row {
            row-gap: 1.2rem;
        }
        .cart-badge {
            position: absolute;
            top: 0.2rem;
            right: 0.2rem;
            font-size: 0.7rem;
            background: #dc3545;
            color: #fff;
            border-radius: 50%;
            padding: 0.15em 0.45em;
            z-index: 2;
        }
        .bootstrap-toast {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 1080;
            min-width: 220px;
            max-width: 320px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.15);
        }
        
        /* Fix for navbar dropdown positioning */
        .dropdown-menu {
            left: auto !important;
            right: 0 !important;
        }
        
        @media (max-width: 767px) {
            .dropdown-menu {
                width: 100%;
                position: absolute !important;
            }
        }
    </style>
</head>
<body dir="ltr">

<x-app-layout>
<!-- Page Header -->
<header class="page-header text-center">
    <div class="container">
        <h1>E-Pharmacy</h1>
        <p>Browse a wide range of medicines and order easily from your home</p>
    </div>
</header>

<!-- Quick Action Buttons -->
<div class="container mb-4">
    <div class="d-flex justify-content-end">
        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary position-relative me-2" style="padding: 0.5rem 1rem;">
            <i class="fas fa-shopping-cart me-1"></i> Cart
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count(session('cart', [])) }}
            </span>
        </a>
        <a href="{{ route('order.items') }}" class="btn btn-outline-success" style="padding: 0.5rem 1rem;">
            <i class="fas fa-history me-1"></i> Order History
        </a>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Sidebar Panel -->
        <div class="col-md-3 splitter-col">
            <div class="sidebar-panel">
                <h5 class="mb-3">Search Medicines</h5>
                <form method="GET" action="{{ route('pharma.index') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search medicine name..." value="{{ request('q') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <h5 class="mb-3">Categories</h5>
                <div class="category-buttons">
                    <a href="{{ route('pharma.index') }}" class="btn btn-outline-primary {{ request('category') == '' ? 'active' : '' }}">
                        <i class="fas fa-th-large me-1"></i> All
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('pharma.index', ['category' => $cat->id]) }}"
                           class="btn btn-outline-primary {{ request('category') == $cat->id ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-9">
            <h2 class="text-center pharma-header">Medicine List</h2>
            <div class="row medicine-list-row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                @php $cart = session('cart', []); @endphp
                @forelse ($medicines as $med)
                    <div class="col d-flex">
                        <div class="card medicine-card flex-fill">
                            <img src="{{ $med->image ? asset('img/' . $med->image) : 'https://via.placeholder.com/150' }}"
                                 class="card-img-top" alt="{{ $med->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $med->name }}</h5>
                                <p class="card-text">{{ Str::limit($med->description, 60) }}</p>
                                <div class="price">${{ $med->price }}</div>
                                <div class="cart-actions" id="cart-actions-{{ $med->id }}">
                                    @if(array_key_exists($med->id, $cart))
                                        <a href="{{ route('pharma.removeFromCart', $med->id) }}"
                                           class="btn btn-danger btn-cart btn-remove-cart remove-from-cart-btn" data-id="{{ $med->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <span class="btn btn-secondary btn-cart flex-grow-1 disabled">
                                            <i class="fas fa-check me-1"></i> In Cart
                                        </span>
                                    @else
                                        <a href="{{ route('pharma.addToCart', $med->id) }}"
                                           class="btn btn-success btn-cart btn-add-cart add-to-cart-btn" data-id="{{ $med->id }}">
                                            <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-result">
                            <i class="fas fa-search mb-3"></i>
                            <h4>No matching medicines found</h4>
                            <p class="text-muted">Try searching with different keywords or browse all medicines.</p>
                            <a href="{{ route('pharma.index') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-th-large me-1"></i> View All Medicines
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            <!-- Pagination (if available) -->
            @if($medicines->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $medicines->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            function updateCartCount() {
                $.get("{{ route('cart.count') }}", function(data) {
                    $("#cart-count-navbar").text(data.count);
                });
            }
            
            function showToast(message) {
                const toastHtml = `
                    <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>`;
                $('#cart-toast-container').html(toastHtml).fadeIn(200);
                setTimeout(function(){ $('#cart-toast-container').fadeOut(500); }, 1800);
            }
            
            function checkAuth(callback) {
                callback(true); // If you want to check login status, adjust this part
            }
            
            $(document).on('click', '.add-to-cart-btn', function (e) {
                e.preventDefault();
                const $btn = $(this);
                const productId = $btn.data('id');
                const actionsContainer = $(`#cart-actions-${productId}`);
                
                checkAuth(function (isAuthenticated) {
                    if (isAuthenticated) {
                        const url = "{{ route('pharma.addToCart', ':id') }}".replace(':id', productId);
                        $.get(url, function (response) {
                            if (response.success) {
                                showToast('Added to cart successfully!');
                                updateCartCount();
                                
                                // Replace the button container with new buttons
                                actionsContainer.html(`
                                    <a href="{{ route('pharma.removeFromCart', ':id') }}" class="btn btn-danger btn-cart btn-remove-cart remove-from-cart-btn" data-id="${productId}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <span class="btn btn-secondary btn-cart flex-grow-1 disabled">
                                        <i class="fas fa-check me-1"></i> In Cart
                                    </span>
                                `.replace(':id', productId));
                            }
                        }).fail(function () {
                            showToast('Error adding product to cart.');
                        });
                    }
                });
            });
            
            // Delegate remove-from-cart-btn click for dynamically added buttons
            $(document).on('click', '.remove-from-cart-btn', function (e) {
                e.preventDefault();
                const $btn = $(this);
                const productId = $btn.data('id');
                const actionsContainer = $(`#cart-actions-${productId}`);
                const url = $btn.attr('href');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to remove this medicine from the cart?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.get(url, function (response) {
                            if (response.success) {
                                showToast('Removed from cart.');
                                updateCartCount();
                                
                                // Replace with Add to Cart button
                                actionsContainer.html(`
                                    <a href="{{ route('pharma.addToCart', ':id') }}" class="btn btn-success btn-cart btn-add-cart add-to-cart-btn" data-id="${productId}">
                                        <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                    </a>
                                `.replace(':id', productId));
                            }
                        }).fail(function () {
                            showToast('Error removing product.');
                        });
                    }
                });
            });
        });
    </script>
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div id="cart-toast-container" class="bootstrap-toast" style="display:none;"></div>
    </div>
</body>
</html>