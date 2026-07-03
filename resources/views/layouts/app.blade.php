<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Mahasiswa') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --colors-primary: #e60000; /* Vodafone Red */
            --colors-ink: #25282b; /* Near-black */
            --colors-canvas: #ffffff;
            --colors-canvas-soft: #f2f2f2;
            --colors-body: #7e7e7e;
            --colors-mute: #bebebe;
            --colors-on-dark: #ffffff;

            --sidebar-width: 260px;
            --radius-card: 6px;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--colors-canvas-soft);
            color: var(--colors-ink);
            font-size: 14px;
            line-height: 1.6;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--colors-ink);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
            border-right: 1px solid var(--colors-ink);
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .brand-logo-orb {
            width: 38px; height: 38px;
            background: var(--colors-primary);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            flex-shrink: 0;
        }
        .brand-logo-orb i {
            line-height: 1;
        }
        .sidebar-brand h3 {
            color: #ffffff;
            font-weight: 800;
            font-size: 1.05rem;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            margin: 0;
            line-height: 1.2;
        }
        .sidebar-brand span {
            color: var(--colors-mute);
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
            margin-top: 2px;
        }

        .sidebar-section {
            padding: 1.5rem 1.5rem 0.5rem;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.3);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0.5rem 0;
            margin: 0;
            flex: 1;
        }
        .sidebar-menu li { margin-bottom: 2px; }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.9rem 1.5rem;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.04);
            color: #ffffff;
        }
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.04);
            color: #ffffff;
            font-weight: 700;
        }
        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: var(--colors-primary);
        }
        .sidebar-menu a .menu-icon {
            font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            color: rgba(255,255,255,0.4);
            transition: all 0.2s ease;
        }
        .sidebar-menu a:hover .menu-icon,
        .sidebar-menu a.active .menu-icon {
            color: #ffffff;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 0.75rem 1.5rem;
        }

        .sidebar-footer {
            padding: 1rem 0;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .logout-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.9rem 1.5rem;
            color: var(--colors-primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .logout-link:hover {
            background: rgba(230,0,0,0.08);
            color: #ff3333;
        }
        .logout-link .menu-icon {
            font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ── MAIN CONTENT ── */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOP BAR ── */
        .top-bar {
            background: var(--colors-canvas);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--colors-ink);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .top-bar-title h4 {
            font-size: 1.3rem;
            font-weight: 300;
            color: var(--colors-ink);
            margin: 0;
        }
        .top-bar-title p {
            font-size: 0.85rem;
            color: var(--colors-body);
            margin: 0;
        }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }
        .user-avatar {
            width: 38px; height: 38px;
            background: var(--colors-primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: 800;
        }
        .user-info .user-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--colors-ink);
            line-height: 1.2;
        }
        .user-info .user-role {
            font-size: 0.75rem;
            color: var(--colors-body);
        }

        /* ── PAGE CONTENT ── */
        .page-content {
            padding: 2rem;
            flex: 1;
        }

        /* ── CARDS ── */
        .card {
            background: var(--colors-canvas);
            border: 1px solid var(--colors-ink);
            border-radius: var(--radius-card);
            box-shadow: none;
            overflow: hidden;
        }
        .card-header {
            background: var(--colors-canvas);
            border-bottom: 1px solid var(--colors-ink);
            padding: 1.25rem 1.5rem;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--colors-ink);
        }
        .card-body { padding: 1.5rem; }

        /* ── STAT CARDS ── */
        .stat-card {
            border-radius: var(--radius-card);
            padding: 1.8rem;
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            transition: transform 0.2s ease;
            position: relative;
        }
        .stat-card:hover { transform: translateY(-2px); }
        
        /* Lead red card */
        .stat-card.brand-hero {
            background: var(--colors-primary);
            color: #ffffff;
            border: 1px solid var(--colors-primary);
        }
        .stat-card.brand-hero .stat-icon {
            background: rgba(255,255,255,0.15);
            color: #ffffff;
        }
        .stat-card.brand-hero .stat-label {
            color: rgba(255,255,255,0.8);
        }
        .stat-card.brand-hero .stat-sub {
            color: rgba(255,255,255,0.7);
        }
        
        /* Supporting white cards */
        .stat-card.brand-flat {
            background: var(--colors-canvas);
            color: var(--colors-ink);
            border: 1px solid var(--colors-ink);
        }
        .stat-card.brand-flat .stat-icon {
            background: var(--colors-canvas-soft);
            color: var(--colors-ink);
            border: 1px solid var(--colors-ink);
        }
        .stat-card.brand-flat .stat-label {
            color: var(--colors-body);
        }
        .stat-card.brand-flat .stat-sub {
            color: var(--colors-body);
        }

        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .stat-card .stat-label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.3rem;
        }
        .stat-card .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }
        .stat-card .stat-sub {
            font-size: 0.8rem;
            margin-top: 0.4rem;
        }

        /* ── TABLES ── */
        .table-wrapper {
            background: var(--colors-canvas);
            border-radius: var(--radius-card);
            border: 1px solid var(--colors-ink);
            overflow: hidden;
            box-shadow: none;
        }
        .table { margin: 0; font-size: 0.9rem; }
        .table thead th {
            background: var(--colors-canvas-soft);
            color: var(--colors-ink);
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid var(--colors-ink);
            white-space: nowrap;
        }
        .table tbody td {
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid var(--colors-canvas-soft);
            vertical-align: middle;
            color: var(--colors-ink);
        }
        .table tbody tr:last-child td { border-bottom: 0; }
        .table tbody tr:hover td { background: var(--colors-canvas-soft); }

        /* ── BUTTONS ── */
        .btn-pill-primary {
            background-color: var(--colors-primary) !important;
            color: #ffffff !important;
            border: 1px solid var(--colors-primary) !important;
            border-radius: 60px !important;
            padding: 0.65rem 1.6rem !important;
            font-weight: 700 !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-pill-primary:hover {
            opacity: 0.9 !important;
            transform: translateY(-1px);
        }
        
        .btn-pill-outline-red {
            background-color: var(--colors-canvas) !important;
            color: var(--colors-primary) !important;
            border: 1px solid var(--colors-primary) !important;
            border-radius: 60px !important;
            padding: 0.65rem 1.6rem !important;
            font-weight: 700 !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-pill-outline-red:hover {
            background-color: var(--colors-canvas-soft) !important;
        }

        .btn-pill-outline-dark {
            background-color: var(--colors-canvas) !important;
            color: var(--colors-ink) !important;
            border: 1px solid var(--colors-ink) !important;
            border-radius: 60px !important;
            padding: 0.65rem 1.6rem !important;
            font-weight: 700 !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-pill-outline-dark:hover {
            background-color: var(--colors-canvas-soft) !important;
            color: var(--colors-ink) !important;
        }

        /* Sleek action buttons */
        .btn-action-edit {
            width: 32px; height: 32px;
            background: #ffffff !important;
            color: var(--colors-ink) !important;
            border: 1px solid var(--colors-ink) !important;
            border-radius: 50% !important;
            display: inline-flex !important;
            align-items: center; justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.8rem;
        }
        .btn-action-edit:hover {
            background: var(--colors-ink) !important;
            color: #ffffff !important;
        }

        .btn-action-delete {
            width: 32px; height: 32px;
            background: #ffffff !important;
            color: var(--colors-primary) !important;
            border: 1px solid var(--colors-primary) !important;
            border-radius: 50% !important;
            display: inline-flex !important;
            align-items: center; justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .btn-action-delete:hover {
            background: var(--colors-primary) !important;
            color: #ffffff !important;
        }

        /* ── FORMS ── */
        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--colors-ink);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control, .form-select {
            border: 1px solid var(--colors-ink);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            color: var(--colors-ink);
            background: var(--colors-canvas);
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--colors-primary);
            box-shadow: 0 0 0 3px rgba(230, 0, 0, 0.1);
            outline: none;
        }
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--colors-primary);
        }
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(230, 0, 0, 0.1);
        }
        .invalid-feedback { font-size: 0.8rem; color: var(--colors-primary); font-weight: 600; }
        .form-text { font-size: 0.8rem; color: var(--colors-body); }

        /* ── BADGE CHIP ── */
        .badge-chip {
            background: var(--colors-canvas-soft);
            color: var(--colors-ink);
            font-weight: 700;
            font-size: 0.78rem;
            padding: 0.25rem 0.75rem;
            border-radius: 32px;
            display: inline-block;
        }

        /* ── ALERTS ── */
        .alert {
            border-radius: var(--radius-card);
            border: 1px solid var(--colors-ink);
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--colors-canvas);
            color: var(--colors-ink);
            box-shadow: none;
        }
        .alert-success { border-color: #10b981; color: #065f46; background: #ecfdf5; }
        .alert-danger { border-color: var(--colors-primary); color: #991b1b; background: #fef2f2; }

        /* ── SECTION HEADER ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .section-header h5 {
            font-size: 1.25rem;
            font-weight: 300;
            color: var(--colors-ink);
            margin: 0;
        }

        /* ── BREAKDOWN CARD ── */
        .breakdown-card {
            background: var(--colors-canvas);
            border: 1px solid var(--colors-ink);
            border-radius: var(--radius-card);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }
        .breakdown-card:hover { border-color: var(--colors-primary); background: var(--colors-canvas-soft); }
        .breakdown-card .name { font-weight: 700; font-size: 0.9rem; color: var(--colors-ink); }
        .breakdown-card .sub { font-size: 0.75rem; color: var(--colors-body); margin-top: 0.15rem; }
        .breakdown-card .count { font-size: 1.6rem; font-weight: 800; color: var(--colors-primary); }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--colors-body);
        }
        .empty-state .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
            opacity: 0.5;
            color: var(--colors-body);
        }
        .empty-state p { margin: 0; font-size: 0.9rem; }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        /* ── NIM BADGE ── */
        .nim-badge {
            font-family: 'Inter', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--colors-ink);
            background: var(--colors-canvas-soft);
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            border: 1px solid var(--colors-mute);
        }

        /* ── ROW NUMBER ── */
        .row-num {
            width: 26px; height: 26px;
            background: var(--colors-canvas-soft);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--colors-body);
            border: 1px solid var(--colors-mute);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .page-content { padding: 1.25rem; }
        }
    </style>
</head>
<body>
    @auth
    <!-- SIDEBAR -->
    <nav class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo-orb">
                <i class="bi bi-quote"></i>
            </div>
            <div>
                <h3>Sistem Mahasiswa</h3>
                <span>Manajemen Akademik</span>
            </div>
        </div>

        <div class="sidebar-section">Menu Utama</div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="bi bi-grid-fill"></i></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.index') }}" class="{{ request()->routeIs('mahasiswa.index') || request()->routeIs('mahasiswa.edit') || request()->routeIs('mahasiswa.show') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="bi bi-people-fill"></i></span>
                    Data Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.create') }}" class="{{ request()->routeIs('mahasiswa.create') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="bi bi-plus-circle-fill"></i></span>
                    Tambah Data
                </a>
            </li>
        </ul>

        <div class="sidebar-divider"></div>

        <div class="sidebar-footer">
            <a href="#" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="menu-icon"><i class="bi bi-box-arrow-right"></i></span>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </nav>

    <!-- MAIN -->
    <div class="main-wrapper">
        <!-- TOP BAR -->
        <div class="top-bar">
            <div class="top-bar-title">
                @yield('page-title-bar',
                    '<h4>'.config('app.name', 'Sistem Mahasiswa').'</h4>'
                )
            </div>
            <div class="top-bar-right">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div class="page-content">
            @yield('content')
        </div>
    </div>

    @else
    <!-- GUEST (login/register pages) -->
    @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
