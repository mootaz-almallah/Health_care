<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - E-Pharmacy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
        
        .order-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .order-header {
            color: #0d6efd;
            font-weight: 600;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        
        .order-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .order-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .order-toggle-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .order-toggle-btn:hover {
            background-color: #f0f0f0;
        }
        
        .order-details {
            display: none;
            border-top: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .product-img {
            border-radius: 10px;
            transition: transform 0.3s ease;
            object-fit: cover;
        }
        
        .product-img:hover {
            transform: scale(1.05);
        }
        
        .empty-orders {
            padding: 60px 30px;
            text-align: center;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        
        .empty-orders i {
            font-size: 80px;
            color: #bdbdbd;
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        
        .btn-outline-primary, .btn-outline-danger {
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover, .btn-outline-danger:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <x-app-layout>
    
    <!-- Page Header -->
    <header class="page-header text-center">
        <div class="container">
            <h1>My Orders</h1>
            <p>View and manage all your previous orders</p>
        </div>
    </header>

    <div class="container">
        <div class="order-container">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-clipboard-list text-primary me-3" style="font-size: 28px;"></i>
                <h2 class="mb-0 order-header">Order History</h2>
            </div>

            @if(count($orders) > 0)
                <div class="row">
                    @foreach($orders as $order)
                        <div class="col-lg-12">
                            <div class="card order-card shadow-sm">
                                <div class="card-header bg-white border-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0 d-flex align-items-center">
                                                <i class="fas fa-shopping-bag me-2 text-primary"></i>
                                                <span>Order #{{ $order->id }}</span>
                                                @if($order->status == 'completed')
                                                    <span class="badge bg-success rounded-pill ms-2">
                                                        <i class="fas fa-check-circle"></i> Completed
                                                    </span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge bg-danger rounded-pill ms-2">
                                                        <i class="fas fa-times-circle"></i> Cancelled
                                                    </span>
                                                @else
                                                    <span class="badge bg-info rounded-pill ms-2">
                                                        <i class="fas fa-clock"></i> Processing
                                                    </span>
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-3 fs-6">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ $order->created_at->format('Y-m-d') }}
                                            </span>
                                            <span class="text-muted me-3 fs-6">
                                                <i class="far fa-clock"></i>
                                                {{ $order->created_at->format('h:i A') }}
                                            </span>
                                            <span class="border rounded-pill py-2 px-3 text-primary fw-bold">
                                                ${{ number_format($order->total_amount, 2) }}
                                            </span>
                                            <button class="btn btn-light border-0 ms-2 order-toggle-btn" id="order-toggle-btn-{{ $order->id }}" onclick="toggleOrderDetails({{ $order->id }})">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-details" id="order-details-{{ $order->id }}">
                                    <div class="card-body">
                                        <h6 class="mb-3 text-primary">
                                            <i class="fas fa-box-open me-2"></i> Order Details
                                        </h6>

                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover">
                                                <thead class="bg-light text-muted">
                                                    <tr>
                                                        <th width="80" class="rounded-start">Image</th>
                                                        <th>Product</th>
                                                        <th width="100">Price</th>
                                                        <th width="100">Quantity</th>
                                                        <th width="120" class="rounded-end">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                        <tr class="align-middle">
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    @if($item->pharma && $item->pharma->image)
                                                                        <img src="{{ asset('img/' . $item->pharma->image) }}" alt="{{ $item->pharma->name ?? 'Medicine' }}" class="product-img" style="width: 50px; height: 50px; object-fit: cover;">
                                                                    @else
                                                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                                            <i class="fas fa-prescription-bottle-alt fa-lg text-muted"></i>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-0">{{ $item->pharma->name ?? 'Product not available' }}</h6>
                                                                @if($item->pharma && $item->pharma->category)
                                                                    <small class="text-muted">{{ $item->pharma->category->name ?? '' }}</small>
                                                                @endif
                                                            </td>
                                                            <td class="text-muted">${{ number_format($item->price, 2) }}</td>
                                                            <td>
                                                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $item->quantity }}</span>
                                                            </td>
                                                            <td class="fw-bold">${{ number_format($item->total, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <div class="card bg-light border-0">
                                                    <div class="card-body p-3">
                                                        <h6 class="mb-3">
                                                            <i class="fas fa-truck me-2"></i> Shipping Information
                                                        </h6>
                                                        <p class="mb-2">
                                                            <span class="text-muted">Address:</span> 
                                                            <span>{{ Auth::user()->address ?? 'Address saved in your account' }}</span>
                                                        </p>
                                                        <p class="mb-2">
                                                            <span class="text-muted">Shipping Method:</span> 
                                                            <span>Standard Shipping (1-3 days)</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="text-muted">Status:</span> 
                                                            @if($order->status == 'completed')
                                                                <span class="text-success">Delivered</span>
                                                            @elseif($order->status == 'cancelled')
                                                                <span class="text-danger">Cancelled</span>
                                                            @else
                                                                <span class="text-primary">Processing</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card bg-light border-0">
                                                    <div class="card-body p-3">
                                                        <h6 class="mb-3">
                                                            <i class="fas fa-credit-card me-2"></i> Payment Information
                                                        </h6>
                                                        <p class="mb-2">
                                                            <span class="text-muted">Payment Method:</span> 
                                                            <span>{{ $order->payment_method ?? 'Cash on Delivery' }}</span>
                                                        </p>
                                                        <p class="mb-2">
                                                            <span class="text-muted">Subtotal:</span> 
                                                            <span>${{ number_format($order->total_amount - 5, 2) }}</span>
                                                        </p>
                                                        <p class="mb-2">
                                                            <span class="text-muted">Shipping Fee:</span> 
                                                            <span>$5.00</span>
                                                        </p>
                                                        <p class="mb-0 fw-bold">
                                                            <span class="text-muted">Total:</span> 
                                                            <span>${{ number_format($order->total_amount, 2) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($order->status != 'cancelled')
                                            <div class="text-end mt-4">
                                                <button class="btn btn-outline-primary me-2">
                                                    <i class="far fa-file-alt me-1"></i> Print Invoice
                                                </button>
                                                @if($order->status != 'completed')
                                                    <button class="btn btn-outline-danger">
                                                        <i class="fas fa-times me-1"></i> Cancel Order
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-orders">
                    <i class="fas fa-shopping-basket"></i>
                    <h4 class="mt-3">No orders found</h4>
                    <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping now!</p>
                    <a href="{{ route('pharma.index') }}" class="btn btn-primary px-4">
                        <i class="fas fa-shopping-basket me-2"></i> Shop Now
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    </x-app-layout>

    <!-- Bootstrap, jQuery and other scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleOrderDetails(orderId) {
            const detailsElement = document.getElementById(`order-details-${orderId}`);
            const buttonElement = document.getElementById(`order-toggle-btn-${orderId}`);
            
            if (detailsElement.style.display === 'block') {
                detailsElement.style.display = 'none';
                buttonElement.innerHTML = '<i class="fas fa-chevron-down"></i>';
            } else {
                detailsElement.style.display = 'block';
                buttonElement.innerHTML = '<i class="fas fa-chevron-up"></i>';
            }
        }
        
        $(document).ready(function() {
            // Show first order details automatically if orders exist
            @if(count($orders) > 0)
                toggleOrderDetails({{ $orders->first()->id }});
            @endif
        });
    </script>
</body>
</html>
