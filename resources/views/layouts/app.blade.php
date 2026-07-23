<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') |Restaurant ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --brand-color: #b5321c;
        }
        body { background-color: #f5f6f8; }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #1e2530;
            color: #cfd3da;
        }
        .sidebar .nav-link { color: #cfd3da; border-radius: .5rem; padding: .55rem .9rem; }
        .sidebar .nav-link i { width: 22px; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { background: var(--brand-color); color: #fff; }
        .sidebar .brand { color: #fff; font-weight: 700; font-size: 1.1rem; }
        .content-wrap { min-width: 0; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; }
        .stat-card { border: none; border-radius: .75rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .badge-role { font-size: .7rem; }
        @media (max-width: 991.98px) {
            .sidebar { position: fixed; z-index: 1045; left: -100%; top: 0; transition: left .25s ease; }
            .sidebar.show { left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar p-3 d-flex flex-column" id="sidebar">
        <div class="brand mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-egg-fried fs-4"></i>
            <span>Restaurant ERP</span>
        </div>
        <ul class="nav nav-pills flex-column gap-1 flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            @auth
            @php($role = auth()->user()->role)

            @if(in_array($role, ['admin','manager']))
            <li class="nav-item mt-2"><small class="text-uppercase text-secondary px-2">Menu</small></li>
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Categories
                </a>
            </li>
            @endif

            @if(in_array($role, ['admin','manager','waiter']))
            <li class="nav-item">
                <a href="{{ route('menu-items.index') }}" class="nav-link {{ request()->routeIs('menu-items.*') ? 'active' : '' }}">
                    <i class="bi bi-egg-fried"></i> Menu Items
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tables.index') }}" class="nav-link {{ request()->routeIs('tables.*') ? 'active' : '' }}">
                    <i class="bi bi-table"></i> Tables
                </a>
            </li>
            @endif

            @if(in_array($role, ['admin','manager','waiter']))
            <li class="nav-item mt-2"><small class="text-uppercase text-secondary px-2">Operations</small></li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Customers
                </a>
            </li>
            @endif

            @if(in_array($role, ['admin','manager','kitchen']))
            <li class="nav-item">
                <a href="{{ route('kitchen.index') }}" class="nav-link {{ request()->routeIs('kitchen.*') ? 'active' : '' }}">
                    <i class="bi bi-fire"></i> Kitchen
                </a>
            </li>
            @endif

            @if(in_array($role, ['admin','manager','cashier']))
            <li class="nav-item mt-2"><small class="text-uppercase text-secondary px-2">Billing</small></li>
            <li class="nav-item">
                <a href="{{ route('payments.index') }}" class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i> Payments
                </a>
            </li>
            @endif

            @if(in_array($role, ['admin','manager']))
            <li class="nav-item mt-2"><small class="text-uppercase text-secondary px-2">Management</small></li>
            <li class="nav-item">
                <a href="{{ route('inventory.index') }}" class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Inventory
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i> Suppliers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i> Reports
                </a>
            </li>
            @endif
            @endauth
        </ul>

        @auth
        <div class="border-top border-secondary-subtle pt-3 mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100" type="submit">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
        @endauth
    </nav>

    <div class="sidebar-overlay d-lg-none" id="sidebarOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); z-index:1040;"></div>

    <!-- Main content -->
    <div class="flex-grow-1 content-wrap">
        <nav class="navbar topbar sticky-top px-3 py-2">
            <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle" type="button">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="fw-semibold ms-2 ms-lg-0">@yield('title', 'Dashboard')</span>
            <div class="ms-auto d-flex align-items-center gap-2">
                @auth
                <span class="badge bg-secondary badge-role text-uppercase">{{ auth()->user()->role }}</span>
                <span class="d-none d-sm-inline text-secondary small">{{ auth()->user()->name }}</span>
                @endauth
            </div>
        </nav>

        <main class="p-3 p-lg-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');

    function openSidebar() {
        sidebar.classList.add('show');
        overlay.style.display = 'block';
    }
    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    }
    toggleBtn?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>
@stack('scripts')
</body>
</html>
