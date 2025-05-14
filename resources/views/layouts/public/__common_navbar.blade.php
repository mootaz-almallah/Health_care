                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pharma.index') ? 'active' : '' }}" href="{{ route('pharma.index') }}">
                        <i class="fas fa-pills"></i> Pharmacy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pharma.categories') ? 'active' : '' }}" href="{{ route('pharma.categories') }}">
                        <i class="fas fa-th-list"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i> Cart 
                        <span class="badge bg-danger rounded-pill cart-count">{{ count(session('cart', [])) }}</span>
                    </a>
                </li> 