<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('admin.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w:  220px;
            --bg:         #0e0f11;
            --bg2:        #161719;
            --bg3:        #1e1f22;
            --border:     #2a2c30;
            --border2:    #333538;
            --text:       #e8e9eb;
            --text2:      #8a8d92;
            --text3:      #555860;
            --accent:     #4f7fff;
            --accent-dk:  #3d6be8;
            --green:      #2ecc8a;
            --purple:     #9b7ff4;
            --orange:     #f59c42;
            --red:        #e05c5c;
            --font:       'IBM Plex Sans', sans-serif;
            --mono:       'IBM Plex Mono', monospace;
        }

        html, body {
            height: 100%;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
        }

        body {
            display: flex;
            min-height: 100vh;
        }

        /* ─── Scrollbar ─────────────────────────────────────── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg2); }
        ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }

        /* ─── Sidebar ───────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg2);
            border-right: 1px solid var(--border);
            position: fixed;
            top: 0; left: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 20px 16px 18px;
            border-bottom: 1px solid var(--border);
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 32px; height: 32px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-icon svg { width: 17px; height: 17px; color: white; }
        .brand-name { font-size: 14px; font-weight: 600; color: var(--text); line-height: 1.2; }
        .brand-sub  { font-size: 10px; color: var(--text3); text-transform: uppercase; letter-spacing: 1.2px; margin-top: 1px; }

        .sidebar-nav { padding: 14px 10px; flex: 1; }

        .nav-label {
            font-size: 10px;
            color: var(--text3);
            text-transform: uppercase;
            letter-spacing: 1.4px;
            padding: 0 8px;
            margin: 14px 0 4px;
            display: block;
        }
        .nav-label:first-child { margin-top: 0; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 7px;
            color: var(--text2);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 1px;
            border-left: 2px solid transparent;
            transition: color .12s, background .12s;
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .nav-item:hover { color: var(--text); background: var(--bg3); }
        .nav-item.active {
            color: var(--accent);
            background: rgba(79,127,255,.08);
            border-left-color: var(--accent);
        }

        .sidebar-footer {
            padding: 14px 10px;
            border-top: 1px solid var(--border);
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 7px;
        }
        .user-avatar {
            width: 30px; height: 30px;
            background: var(--accent);
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 600; color: #fff;
            flex-shrink: 0;
        }
        .user-name { font-size: 13px; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 10px; color: var(--text3); margin-top: 1px; }
        .logout-btn {
            background: none; border: none; cursor: pointer;
            color: var(--text3); padding: 4px; border-radius: 5px;
            display: flex; transition: color .12s;
        }
        .logout-btn:hover { color: var(--red); }
        .logout-btn svg { width: 15px; height: 15px; }

        /* ─── Main wrapper ──────────────────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── Topbar ────────────────────────────────────────── */
        .topbar {
            background: var(--bg2);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title { font-size: 15px; font-weight: 600; color: var(--text); }
        .topbar-breadcrumb { font-size: 11px; color: var(--text3); margin-top: 1px; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-chip {
            display: flex; align-items: center; gap: 6px;
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 5px 11px;
            font-size: 11px;
            color: var(--text2);
        }
        .dot-live { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 5px var(--green); }

        /* ─── Page content ──────────────────────────────────── */
        .page-content { padding: 24px; flex: 1; }

        /* ─── Card ──────────────────────────────────────────── */
        .card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px;
        }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--text); }
        .card-subtitle { font-size: 12px; color: var(--text3); margin-top: 2px; }
        .card-body     { padding: 20px; }
        .card-footer   { padding: 14px 20px; border-top: 1px solid var(--border); }
        .divider       { height: 1px; background: var(--border); }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute; top: 0; right: 0;
            width: 64px; height: 64px;
            border-radius: 0 10px 0 64px;
            opacity: .07;
        }
        .stat-card.blue::before   { background: var(--accent); }
        .stat-card.green::before  { background: var(--green); }
        .stat-card.purple::before { background: var(--purple); }
        .stat-card.orange::before { background: var(--orange); }

        .stat-label { font-size: 11px; color: var(--text3); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .stat-value { font-size: 28px; font-weight: 600; color: var(--text); letter-spacing: -1px; font-family: var(--mono); }
        .stat-sub   { font-size: 11px; color: var(--text3); margin-top: 6px; display: flex; align-items: center; gap: 5px; }
        .stat-tag   { display: inline-flex; align-items: center; gap: 4px; font-size: 10px; padding: 2px 7px; border-radius: 4px; font-weight: 500; }
        .tag-blue   { background: rgba(79,127,255,.12);  color: #6b96ff; }
        .tag-green  { background: rgba(46,204,138,.12);  color: #2ecc8a; }
        .tag-purple { background: rgba(155,127,244,.12); color: #b09af7; }
        .tag-orange { background: rgba(245,156,66,.12);  color: #f5a655; }

        /* ─── Buttons ───────────────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 15px; border-radius: 7px;
            font-size: 13px; font-weight: 500;
            cursor: pointer; border: none;
            text-decoration: none;
            transition: all .12s;
            line-height: 1;
            white-space: nowrap;
            font-family: var(--font);
        }
        .btn svg { width: 14px; height: 14px; }
        .btn-primary   { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dk); }
        .btn-secondary { background: var(--bg3); color: var(--text2); border: 1px solid var(--border2); }
        .btn-secondary:hover { color: var(--text); border-color: var(--text3); }
        .btn-danger    { background: rgba(224,92,92,.12); color: var(--red); border: 1px solid rgba(224,92,92,.2); }
        .btn-danger:hover { background: rgba(224,92,92,.2); }
        .btn-warning   { background: rgba(245,156,66,.12); color: var(--orange); border: 1px solid rgba(245,156,66,.2); }
        .btn-warning:hover { background: rgba(245,156,66,.2); }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 6px;
            background: transparent; border: 1px solid var(--border2);
            border-radius: 6px; padding: 7px 14px;
            font-size: 12px; color: var(--text2);
            text-decoration: none; cursor: pointer;
            transition: border-color .12s, color .12s;
            font-family: var(--font);
        }
        .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }
        .btn-ghost svg { width: 13px; height: 13px; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .btn-sm svg { width: 13px; height: 13px; }

        /* ─── Table ─────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            font-size: 11px; text-transform: uppercase; letter-spacing: .8px;
            color: var(--text3); font-weight: 500;
            padding: 10px 20px; text-align: left;
            border-bottom: 1px solid var(--border);
        }
        tbody tr { border-bottom: 1px solid var(--border); transition: background .1s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,.02); }
        tbody td { padding: 12px 20px; font-size: 13px; color: var(--text); vertical-align: middle; }
        .td-actions { display: flex; gap: 6px; align-items: center; }

        /* ─── Badge ─────────────────────────────────────────── */
        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 9px; border-radius: 5px; font-size: 11px; font-weight: 500; }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; }
        .badge-green  { background: rgba(46,204,138,.1);  color: #2ecc8a; }
        .badge-blue   { background: rgba(79,127,255,.1);  color: #6b96ff; }
        .badge-gray   { background: rgba(138,141,146,.1); color: #8a8d92; }
        .badge-red    { background: rgba(224,92,92,.1);   color: #e05c5c; }
        .badge-orange { background: rgba(245,156,66,.1);  color: #f5a655; }
        .badge-dot-green  { background: #2ecc8a; }
        .badge-dot-blue   { background: #6b96ff; }
        .badge-dot-gray   { background: #8a8d92; }
        .badge-dot-red    { background: #e05c5c; }
        .badge-dot-orange { background: #f5a655; }

        /* ─── Forms ─────────────────────────────────────────── */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label { font-size: 12px; font-weight: 600; color: var(--text2); text-transform: uppercase; letter-spacing: .6px; }
        .form-label .req { color: var(--red); margin-left: 2px; }
        .form-control {
            padding: 9px 12px;
            border: 1px solid var(--border2);
            border-radius: 7px;
            font-size: 13px;
            font-family: var(--font);
            color: var(--text);
            background: var(--bg3);
            transition: border-color .12s, box-shadow .12s;
            outline: none;
            width: 100%;
        }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(79,127,255,.12); }
        .form-control.is-invalid { border-color: var(--red); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(224,92,92,.12); }
        .form-control::placeholder { color: var(--text3); }
        textarea.form-control { resize: vertical; min-height: 90px; }
        select.form-control { cursor: pointer; }
        .invalid-feedback { font-size: 12px; color: var(--red); font-weight: 500; }

        /* ─── Search ────────────────────────────────────────── */
        .search-wrap { position: relative; }
        .search-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: var(--text3); pointer-events: none; }
        .search-wrap .form-control { padding-left: 34px; }

        /* ─── Filter bar ────────────────────────────────────── */
        .filter-bar { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-bottom: 16px; }
        .filter-bar .form-control { width: auto; min-width: 130px; }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 10px;
            padding: 14px 20px;
            border-top: 1px solid var(--border);
        }
        .pagination-info { font-size: 12px; color: var(--text3); }
        .pagination-btns { display: flex; gap: 4px; }
        .page-btn {
            padding: 5px 11px; border-radius: 5px;
            border: 1px solid var(--border2); background: transparent;
            font-size: 12px; color: var(--text2);
            text-decoration: none; display: inline-flex; align-items: center;
            transition: border-color .12s, color .12s, background .12s;
            font-family: var(--font);
        }
        .page-btn:hover { border-color: var(--accent); color: var(--accent); }
        .page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
        .page-btn.disabled { opacity: .3; cursor: not-allowed; pointer-events: none; }

        /* ─── Toast ─────────────────────────────────────────── */
        .toast-container { position: fixed; top: 18px; right: 18px; z-index: 9999; display: flex; flex-direction: column; gap: 8px; }
        .toast {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 16px;
            border-radius: 8px;
            min-width: 260px; max-width: 360px;
            animation: toastIn .25s ease;
        }
        @keyframes toastIn { from { opacity:0; transform: translateX(16px); } to { opacity:1; transform: translateX(0); } }
        .toast-success { background: var(--bg3); border: 1px solid rgba(46,204,138,.3); color: var(--green); }
        .toast-error   { background: var(--bg3); border: 1px solid rgba(224,92,92,.3);  color: var(--red); }
        .toast-icon svg { width: 17px; height: 17px; flex-shrink: 0; }
        .toast-text { font-size: 13px; font-weight: 500; flex: 1; color: var(--text); }
        .toast-close { cursor: pointer; background: none; border: none; font-size: 16px; color: var(--text3); padding: 0; transition: color .12s; }
        .toast-close:hover { color: var(--text); }

        /* ─── Empty state ───────────────────────────────────── */
        .empty-state { text-align: center; padding: 48px 20px; }
        .empty-state svg { width: 36px; height: 36px; margin: 0 auto 12px; display: block; stroke: var(--text3); }
        .empty-state-title { font-size: 14px; font-weight: 600; color: var(--text2); margin-bottom: 4px; }
        .empty-state-desc  { font-size: 13px; color: var(--text3); }

        /* ─── Modal ─────────────────────────────────────────── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,.6);
            backdrop-filter: blur(3px);
            z-index: 200;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: var(--bg2);
            border: 1px solid var(--border2);
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,.5);
            width: 420px;
            max-width: calc(100vw - 32px);
            animation: modalIn .2s ease;
        }
        @keyframes modalIn { from { opacity:0; transform: scale(.95); } to { opacity:1; transform: scale(1); } }
        .modal-header { padding: 18px 20px 14px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
        .modal-icon { width: 36px; height: 36px; background: rgba(224,92,92,.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .modal-icon svg { width: 18px; height: 18px; color: var(--red); }
        .modal-title { font-size: 15px; font-weight: 600; color: var(--text); }
        .modal-body { padding: 16px 20px; font-size: 13px; color: var(--text2); line-height: 1.6; }
        .modal-footer { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; gap: 8px; justify-content: flex-end; }

        /* ─── Page header ───────────────────────────────────── */
        .page-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 20px; }
        .page-header-left .page-title { font-size: 20px; font-weight: 600; color: var(--text); }
        .page-header-left .page-desc  { font-size: 13px; color: var(--text3); margin-top: 2px; }

        /* ─── Misc helpers ──────────────────────────────────── */
        .text-muted { color: var(--text2) !important; }
        .font-mono  { font-family: var(--mono); font-size: 12px; color: var(--text2); }
        .fw-600     { font-weight: 600; }

        /* ─── Mobile ────────────────────────────────────────── */
        .mob-toggle { display: none; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .22s ease; }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .mob-toggle {
                display: flex; align-items: center; justify-content: center;
                width: 36px; height: 36px;
                background: var(--bg3); border: 1px solid var(--border);
                border-radius: 7px; cursor: pointer;
            }
            .mob-toggle svg { width: 17px; height: 17px; }
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
                <div class="brand-name">{{ config('admin.name') }}</div>
                <div class="brand-sub">Sistem Manajemen</div>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        <span class="nav-label">Menu</span>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <span class="nav-label">Akademik</span>
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
            <div style="flex:1;min-width:0">
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
            <div class="topbar-chip">
                <span class="dot-live"></span>
                {{ now()->isoFormat('dddd, D MMM Y') }}
            </div>
        </div>
    </header>

    <main class="page-content">
        @yield('content')
    </main>
</div>

<!-- Toast -->
<div class="toast-container" id="toastContainer"></div>

<!-- Delete Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="modal-title">Konfirmasi Hapus</div>
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

function confirmDelete(url, name) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModalBody').textContent =
        'Apakah Anda yakin ingin menghapus "' + name + '"? Tindakan ini tidak dapat dibatalkan.';
    document.getElementById('deleteModal').classList.add('open');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

function showToast(message, type) {
    type = type || 'success';
    var container = document.getElementById('toastContainer');
    var icons = {
        success: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        error:   '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    };
    var toast = document.createElement('div');
    toast.className = 'toast toast-' + type;
    toast.innerHTML = '<div class="toast-icon">' + icons[type] + '</div><div class="toast-text">' + message + '</div><button class="toast-close" onclick="this.closest(\'.toast\').remove()">×</button>';
    container.appendChild(toast);
    setTimeout(function(){ toast.remove(); }, 4500);
}

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