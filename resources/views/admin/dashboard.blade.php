@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Ringkasan & Statistik')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
/* ── Reset & Root ─────────────────────────────────────────── */
:root {
    --bg:       #0e0f11;
    --bg2:      #161719;
    --bg3:      #1e1f22;
    --border:   #2a2c30;
    --border2:  #333538;
    --text:     #e8e9eb;
    --text2:    #8a8d92;
    --text3:    #555860;
    --accent:   #4f7fff;
    --green:    #2ecc8a;
    --purple:   #9b7ff4;
    --orange:   #f59c42;
    --red:      #e05c5c;
    --font:     'IBM Plex Sans', sans-serif;
    --mono:     'IBM Plex Mono', monospace;
}

/* ── Stat Grid ────────────────────────────────────────────── */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
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
    font-family: var(--font);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 64px;
    height: 64px;
    border-radius: 0 10px 0 64px;
    opacity: .07;
}
.stat-card.blue::before   { background: var(--accent); }
.stat-card.green::before  { background: var(--green); }
.stat-card.purple::before { background: var(--purple); }
.stat-card.orange::before { background: var(--orange); }

.stat-label {
    font-size: 11px;
    color: var(--text3);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.stat-value {
    font-size: 28px;
    font-weight: 600;
    color: var(--text);
    letter-spacing: -1px;
    font-family: var(--mono);
}

.stat-sub {
    font-size: 11px;
    color: var(--text3);
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.stat-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    padding: 2px 7px;
    border-radius: 4px;
    font-weight: 500;
}
.tag-blue   { background: rgba(79,127,255,.12); color: #6b96ff; }
.tag-green  { background: rgba(46,204,138,.12); color: #2ecc8a; }
.tag-purple { background: rgba(155,127,244,.12); color: #b09af7; }
.tag-orange { background: rgba(245,156,66,.12);  color: #f5a655; }

/* ── Card ─────────────────────────────────────────────────── */
.card {
    background: var(--bg2);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
    font-family: var(--font);
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
}

.card-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
}

.card-subtitle {
    font-size: 12px;
    color: var(--text3);
    margin-top: 2px;
}

.divider {
    height: 1px;
    background: var(--border);
}

/* ── Button ───────────────────────────────────────────────── */
.btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: transparent;
    border: 1px solid var(--border2);
    border-radius: 6px;
    padding: 7px 14px;
    font-size: 12px;
    color: var(--text2);
    text-decoration: none;
    cursor: pointer;
    transition: border-color .15s, color .15s;
    font-family: var(--font);
}
.btn-ghost:hover {
    border-color: var(--accent);
    color: var(--accent);
}
.btn-ghost svg {
    width: 14px;
    height: 14px;
}

/* ── Table ────────────────────────────────────────────────── */
.table-wrap {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: var(--text3);
    font-weight: 500;
    padding: 10px 20px;
    text-align: left;
    border-bottom: 1px solid var(--border);
    font-family: var(--font);
}

tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .1s;
}
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: rgba(255,255,255,.02); }

td {
    padding: 12px 20px;
    font-size: 13px;
    color: var(--text);
    font-family: var(--font);
}

.text-muted { color: var(--text2) !important; }
.fw-600     { font-weight: 600; }
.font-mono  { font-family: var(--mono); font-size: 12px; color: var(--text2); }

/* ── Badge ────────────────────────────────────────────────── */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 9px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 500;
    font-family: var(--font);
}
.badge-dot { width: 5px; height: 5px; border-radius: 50%; }

.badge-green  { background: rgba(46,204,138,.1);   color: #2ecc8a; }
.badge-blue   { background: rgba(79,127,255,.1);   color: #6b96ff; }
.badge-gray   { background: rgba(138,141,146,.1);  color: #8a8d92; }
.badge-red    { background: rgba(224,92,92,.1);    color: #e05c5c; }

.badge-dot-green  { background: #2ecc8a; }
.badge-dot-blue   { background: #6b96ff; }
.badge-dot-gray   { background: #8a8d92; }
.badge-dot-red    { background: #e05c5c; }

/* ── Empty State ──────────────────────────────────────────── */
.empty-state {
    text-align: center;
    padding: 48px 20px;
    color: var(--text3);
}
.empty-state svg {
    width: 36px;
    height: 36px;
    margin: 0 auto 12px;
    display: block;
    stroke: var(--text3);
}
.empty-state-title { font-size: 14px; font-weight: 600; color: var(--text2); margin-bottom: 4px; }
.empty-state-desc  { font-size: 13px; color: var(--text3); }

/* ── Pagination ───────────────────────────────────────────── */
.pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
}
.pagination-info { font-size: 12px; color: var(--text3); }
.pagination-btns { display: flex; gap: 4px; }

.page-btn {
    padding: 5px 11px;
    border-radius: 5px;
    border: 1px solid var(--border2);
    background: transparent;
    font-size: 12px;
    color: var(--text2);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: border-color .15s, color .15s, background .15s;
    font-family: var(--font);
}
.page-btn:hover { border-color: var(--accent); color: var(--accent); }
.page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
.page-btn.disabled { opacity: .3; cursor: not-allowed; pointer-events: none; }
</style>
@endpush

@section('content')

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card blue">
        <div class="stat-label">Total Siswa</div>
        <div class="stat-value">{{ number_format($stats['total_siswa']) }}</div>
        <div class="stat-sub">
            <span class="stat-tag tag-blue">Semua Data</span>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-label">Siswa Aktif</div>
        <div class="stat-value">{{ number_format($stats['siswa_aktif']) }}</div>
        <div class="stat-sub">
            @if($stats['total_siswa'] > 0)
                <span class="stat-tag tag-green">
                    {{ round(($stats['siswa_aktif'] / $stats['total_siswa']) * 100) }}%
                </span> dari total
            @endif
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-label">Siswa Lulus</div>
        <div class="stat-value">{{ number_format($stats['siswa_lulus']) }}</div>
        <div class="stat-sub">
            <span class="stat-tag tag-purple">Alumni</span>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-label">Total Kelas</div>
        <div class="stat-value">{{ number_format($stats['total_wali_kelas']) }}</div>
        <div class="stat-sub">
            <span class="stat-tag tag-orange">Rombel Aktif</span>
        </div>
    </div>
</div>

{{-- Tabel Siswa --}}
<div class="card" style="margin-top:20px">
    <div class="card-header">
        <div>
            <div class="card-title">Data Siswa</div>
            <div class="card-subtitle">
                Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
            </div>
        </div>
        <a href="{{ route('admin.siswa.index') }}" class="btn-ghost">
            Lihat Semua
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="divider"></div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:50px">No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $item)
                <tr>
                    <td class="text-muted" style="font-size:12px">
                        {{ $siswa->firstItem() + $loop->index }}
                    </td>
                    <td class="fw-600">{{ $item->nama }}</td>
                    <td>
                        <span class="font-mono">{{ $item->nisn }}</span>
                    </td>
                    <td class="text-muted">
                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->isoFormat('D MMM Y') }}
                    </td>
                    <td class="text-muted">
                        {{ $item->waliKelas?->nama_kelas ?? '—' }}
                    </td>
                    <td>
                        @php
                            $badges = [
                                'aktif'       => 'badge-green',
                                'tidak_aktif' => 'badge-gray',
                                'lulus'       => 'badge-blue',
                                'keluar'      => 'badge-red',
                            ];
                            $dots = [
                                'aktif'       => 'badge-dot-green',
                                'tidak_aktif' => 'badge-dot-gray',
                                'lulus'       => 'badge-dot-blue',
                                'keluar'      => 'badge-dot-red',
                            ];
                            $labels = [
                                'aktif'       => 'Aktif',
                                'tidak_aktif' => 'Tidak Aktif',
                                'lulus'       => 'Lulus',
                                'keluar'      => 'Keluar',
                            ];
                        @endphp
                        <span class="badge {{ $badges[$item->status] ?? 'badge-gray' }}">
                            <span class="badge-dot {{ $dots[$item->status] ?? 'badge-dot-gray' }}"></span>
                            {{ $labels[$item->status] ?? $item->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <div class="empty-state-title">Belum Ada Data</div>
                            <div class="empty-state-desc">Tambah siswa pertama untuk memulai</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($siswa->hasPages())
    <div class="pagination-wrap">
        <div class="pagination-info">
            Halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}
        </div>
        <div class="pagination-btns">
            {{-- Prev --}}
            @if($siswa->onFirstPage())
                <span class="page-btn disabled">← Prev</span>
            @else
                <a href="{{ $siswa->previousPageUrl() }}" class="page-btn">← Prev</a>
            @endif

            {{-- Page Numbers --}}
            @foreach($siswa->getUrlRange(max(1, $siswa->currentPage()-2), min($siswa->lastPage(), $siswa->currentPage()+2)) as $page => $url)
                @if($page == $siswa->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if($siswa->hasMorePages())
                <a href="{{ $siswa->nextPageUrl() }}" class="page-btn">Next →</a>
            @else
                <span class="page-btn disabled">Next →</span>
            @endif
        </div>
    </div>
    @endif
</div>

@endsection