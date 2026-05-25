<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('admin.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w: 260px;
            --bg-sidebar: #0f172a;
            --bg-sidebar-hover: rgba(255,255,255,0.06);
            --bg-sidebar-active: rgba(16,185,129,0.15);
            --accent: #10b981;
            --accent-dark: #059669;
            --accent-light: #d1fae5;
            --bg-main: #f1f5f9;
            --bg-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,.08);
            --radius: 12px;
            --radius-sm: 8px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-main);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ─────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg-sidebar);
            position: fixed;
            top: 0; left: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-icon svg { width: 20px; height: 20px; color: white; }
        .brand-text { color: white; font-size: 15px; font-weight: 700; line-height: 1.2; }
        .brand-sub { color: rgba(255,255,255,.4); font-size: 11px; font-weight: 400; }

        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-section-label {
            color: rgba(255,255,255,.3);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 8px 10px 6px;
            margin-top: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: rgba(255,255,255,.55);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all .15s ease;
            margin-bottom: 2px;
        }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
        .nav-item:hover { color: white; background: var(--bg-sidebar-hover); }
        .nav-item.active {
            color: var(--accent);
            background: var(--bg-sidebar-active);
        }
        .nav-item.active svg { color: var(--accent); }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: var(--radius-sm);
        }
        .user-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--accent), #6366f1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: white;
            flex-shrink: 0;
        }
        .user-info { flex: 1; min-width: 0; }
        .user-name { color: white; font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { color: rgba(255,255,255,.35); font-size: 11px; }
        .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255,255,255,.35);
            padding: 4px;
            border-radius: 6px;
            transition: color .15s;
            display: flex;
        }
        .logout-btn:hover { color: #f87171; }
        .logout-btn svg { width: 16px; height: 16px; }

        /* ── Main ────────────────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title { font-size: 17px; font-weight: 700; color: var(--text-primary); }
        .topbar-breadcrumb { font-size: 12.5px; color: var(--text-muted); margin-top: 1px; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .page-content { padding: 28px; flex: 1; }

        /* ── Cards ───────────────────────────────── */
        .card {
            background: var(--bg-card);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }
        .card-header {
            padding: 18px 22px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .card-title { font-size: 15px; font-weight: 700; color: var(--text-primary); }
        .card-subtitle { font-size: 12.5px; color: var(--text-muted); margin-top: 2px; }
        .card-body { padding: 20px 22px; }
        .card-footer {
            padding: 14px 22px;
            border-top: 1px solid var(--border);
            background: #fafbfc;
            border-radius: 0 0 var(--radius) var(--radius);
        }

        /* ── Stat Cards ──────────────────────────── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            padding: 20px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            position: relative;
            overflow: hidden;
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-icon.green  { background: #d1fae5; color: #059669; }
        .stat-icon.blue   { background: #dbeafe; color: #2563eb; }
        .stat-icon.purple { background: #ede9fe; color: #7c3aed; }
        .stat-icon.orange { background: #ffedd5; color: #ea580c; }
        .stat-icon.red    { background: #fee2e2; color: #dc2626; }
        .stat-value { font-size: 28px; font-weight: 800; color: var(--text-primary); line-height: 1; }
        .stat-label { font-size: 12.5px; color: var(--text-muted); font-weight: 500; margin-top: 4px; }

        /* ── Buttons ─────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .15s ease;
            line-height: 1;
            white-space: nowrap;
        }
        .btn svg { width: 15px; height: 15px; }
        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: var(--accent-dark); }
        .btn-secondary { background: var(--bg-main); color: var(--text-secondary); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); }
        .btn-danger { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover { background: #fecaca; }
        .btn-warning { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
        .btn-warning:hover { background: #ffedd5; }
        .btn-sm { padding: 6px 11px; font-size: 12.5px; }
        .btn-sm svg { width: 13px; height: 13px; }

        /* ── Table ───────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        thead th {
            background: #f8fafc;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: 11px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-primary);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #fafbfc; }
        .td-actions { display: flex; gap: 6px; align-items: center; }

        /* ── Badge ───────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }
        .badge-green   { background: #d1fae5; color: #065f46; }
        .badge-red     { background: #fee2e2; color: #991b1b; }
        .badge-blue    { background: #dbeafe; color: #1e40af; }
        .badge-gray    { background: #f1f5f9; color: #475569; }
        .badge-orange  { background: #ffedd5; color: #9a3412; }
        .badge-dot-green  { background: #10b981; }
        .badge-dot-red    { background: #ef4444; }
        .badge-dot-blue   { background: #3b82f6; }
        .badge-dot-gray   { background: #94a3b8; }
        .badge-dot-orange { background: #f97316; }

        /* ── Forms ───────────────────────────────── */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label { font-size: 13px; font-weight: 600; color: var(--text-primary); }
        .form-label .req { color: #ef4444; margin-left: 2px; }
        .form-control {
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-family: inherit;
            color: var(--text-primary);
            background: white;
            transition: border-color .15s, box-shadow .15s;
            outline: none;
            width: 100%;
        }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(16,185,129,.12); }
        .form-control.is-invalid { border-color: #ef4444; }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.12); }
        textarea.form-control { resize: vertical; min-height: 90px; }
        select.form-control { cursor: pointer; }
        .invalid-feedback { font-size: 12px; color: #ef4444; font-weight: 500; }

        /* ── Search bar ──────────────────────────── */
        .search-wrap { position: relative; }
        .search-wrap svg { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: var(--text-muted); pointer-events: none; }
        .search-wrap .form-control { padding-left: 36px; }

        /* ── Filter bar ──────────────────────────── */
        .filter-bar {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .filter-bar .form-control { width: auto; min-width: 140px; }

        /* ── Pagination ──────────────────────────── */
        .pagination-wrap { display: flex; align-items: center; justify-content: space-between; gap: 12px; font-size: 13px; color: var(--text-muted); }
        .pagination { display: flex; gap: 4px; list-style: none; }
        .pagination .page-item .page-link {
            display: flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 8px;
            border: 1px solid var(--border);
            border-radius: 7px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all .12s;
        }
        .pagination .page-item.active .page-link { background: var(--accent); color: white; border-color: var(--accent); }
        .pagination .page-item .page-link:hover:not(.active) { background: var(--bg-main); }
        .pagination .page-item.disabled .page-link { opacity: .4; pointer-events: none; }

        /* ── Toast alerts ────────────────────────── */
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 8px; }
        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: var(--radius);
            box-shadow: 0 8px 32px rgba(0,0,0,.12);
            min-width: 280px;
            max-width: 380px;
            animation: toastIn .3s ease;
            backdrop-filter: blur(8px);
        }
        @keyframes toastIn { from { opacity:0; transform: translateX(20px); } to { opacity:1; transform: translateX(0); } }
        .toast-success { background: #ecfdf5; border: 1px solid #6ee7b7; color: #065f46; }
        .toast-error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }
        .toast-icon svg { width: 18px; height: 18px; flex-shrink: 0; }
        .toast-text { font-size: 13.5px; font-weight: 500; flex: 1; }
        .toast-close { cursor: pointer; opacity: .5; transition: opacity .12s; background: none; border: none; font-size: 16px; color: inherit; padding: 0; }
        .toast-close:hover { opacity: 1; }

        /* ── Empty state ─────────────────────────── */
        .empty-state { text-align: center; padding: 48px 24px; color: var(--text-muted); }
        .empty-state svg { width: 48px; height: 48px; margin: 0 auto 12px; opacity: .35; }
        .empty-state-title { font-size: 15px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; }
        .empty-state-desc { font-size: 13.5px; }

        /* ── Modal ───────────────────────────────── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(15,23,42,.5);
            backdrop-filter: blur(3px);
            z-index: 200;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: white;
            border-radius: var(--radius);
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
            width: 420px;
            max-width: calc(100vw - 32px);
            animation: modalIn .2s ease;
        }
        @keyframes modalIn { from { opacity:0; transform: scale(.95); } to { opacity:1; transform: scale(1); } }
        .modal-header { padding: 20px 22px 16px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
        .modal-icon { width: 40px; height: 40px; background: #fee2e2; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .modal-icon svg { width: 20px; height: 20px; color: #dc2626; }
        .modal-title { font-size: 16px; font-weight: 700; }
        .modal-body { padding: 16px 22px; font-size: 14px; color: var(--text-secondary); line-height: 1.6; }
        .modal-footer { padding: 14px 22px; border-top: 1px solid var(--border); display: flex; gap: 10px; justify-content: flex-end; }

        /* ── Misc ────────────────────────────────── */
        .page-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .page-header-left .page-title { font-size: 22px; font-weight: 800; color: var(--text-primary); }
        .page-header-left .page-desc { font-size: 13.5px; color: var(--text-muted); margin-top: 2px; }
        .divider { height: 1px; background: var(--border); margin: 0 22px; }
        .text-muted { color: var(--text-muted); font-size: 12.5px; }
        .font-mono { font-family: 'Courier New', monospace; }
        .fw-600 { font-weight: 600; }

        /* ── Mobile toggle ───────────────────────── */
        .mob-toggle { display: none; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .mob-toggle { display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; background: var(--bg-main); border: 1px solid var(--border); border-radius: 8px; cursor: pointer; }
            .mob-toggle svg { width: 18px; height: 18px; }
            .form-grid { grid-template-columns: 1fr; }
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .page-content { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <div class="brand-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <div>
                <div class="brand-text">{{ config('admin.name') }}</div>
                <div class="brand-sub">Sistem Manajemen</div>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <div class="nav-section-label">Akademik</div>
        <a href="{{ route('admin.siswa.index') }}"
           class="nav-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Data Siswa
        </a>
        <a href="{{ route('admin.wali-kelas.index') }}"
           class="nav-item {{ request()->routeIs('admin.wali-kelas.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Wali Kelas
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">{{ strtoupper(substr(session('admin_user', 'A'), 0, 1)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ session('admin_user', 'Admin') }}</div>
                <div class="user-role">Administrator</div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Main -->
<div class="main-wrap">
    <header class="topbar">
        <div style="display:flex;align-items:center;gap:12px">
            <button class="mob-toggle" onclick="toggleSidebar()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-breadcrumb">@yield('breadcrumb', 'Panel Akademik')</div>
            </div>
        </div>
        <div class="topbar-right">
            <span style="font-size:12.5px;color:var(--text-muted)">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
        </div>
    </header>

    <main class="page-content">
        @yield('content')
    </main>
</div>

<!-- Toast Notifications -->
<div class="toast-container" id="toastContainer"></div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <div class="modal-title">Konfirmasi Hapus</div>
            </div>
        </div>
        <div class="modal-body" id="deleteModalBody">
            Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

// Delete modal
function confirmDelete(url, name) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModalBody').textContent =
        `Apakah Anda yakin ingin menghapus "${name}"? Tindakan ini tidak dapat dibatalkan.`;
    document.getElementById('deleteModal').classList.add('open');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

// Toast notifications
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    const icons = {
        success: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        error: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
    };
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `<div class="toast-icon">${icons[type]}</div><div class="toast-text">${message}</div><button class="toast-close" onclick="this.closest('.toast').remove()">×</button>`;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4500);
}

// Auto-show flash messages
@if(session('success'))
    showToast(@json(session('success')), 'success');
@endif
@if(session('error'))
    showToast(@json(session('error')), 'error');
@endif
</script>

@stack('scripts')
</body>
</html>