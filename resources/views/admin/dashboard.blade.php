@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Ringkasan & Statistik')

@section('content')

<!-- Stat Cards -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <div class="stat-value">{{ number_format($stats['total_siswa']) }}</div>
            <div class="stat-label">Total Siswa</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <div class="stat-value">{{ number_format($stats['siswa_aktif']) }}</div>
            <div class="stat-label">Siswa Aktif</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div>
            <div class="stat-value">{{ number_format($stats['siswa_lulus']) }}</div>
            <div class="stat-label">Siswa Lulus</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div>
            <div class="stat-value">{{ number_format($stats['total_wali_kelas']) }}</div>
            <div class="stat-label">Total Kelas</div>
        </div>
    </div>
</div>

<!-- Tabel Siswa -->
<div class="card" style="margin-top:20px">
    <div class="card-header" style="padding-bottom:16px">
        <div>
            <div class="card-title">Data Siswa</div>
            <div class="card-subtitle">
                Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
            </div>
        </div>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary btn-sm">
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
                    <td class="text-muted" style="font-size:13px">{{ $siswa->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:32px;height:32px;background:linear-gradient(135deg,#10b981,#6366f1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:white;flex-shrink:0">
                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                            </div>
                            <span class="fw-600">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td><span class="font-mono text-muted">{{ $item->nisn }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->isoFormat('D MMM Y') }}</td>
                    <td>{{ $item->waliKelas?->nama_kelas ?? '—' }}</td>
                    <td>
                        @php
                            $badges = ['aktif'=>'badge-green','tidak_aktif'=>'badge-gray','lulus'=>'badge-blue','keluar'=>'badge-red'];
                            $dots   = ['aktif'=>'badge-dot-green','tidak_aktif'=>'badge-dot-gray','lulus'=>'badge-dot-blue','keluar'=>'badge-dot-red'];
                            $labels = ['aktif'=>'Aktif','tidak_aktif'=>'Tidak Aktif','lulus'=>'Lulus','keluar'=>'Keluar'];
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
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
    <div style="padding:16px 20px;border-top:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
        <div style="font-size:13px;color:var(--text-muted)">
            Halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}
        </div>
        <div style="display:flex;gap:6px;align-items:center">
            {{-- Prev --}}
            @if($siswa->onFirstPage())
                <span style="padding:6px 12px;border-radius:6px;border:1px solid #e2e8f0;font-size:13px;color:#cbd5e1;cursor:not-allowed">← Prev</span>
            @else
                <a href="{{ $siswa->previousPageUrl() }}" style="padding:6px 12px;border-radius:6px;border:1px solid #e2e8f0;font-size:13px;color:var(--text-primary);text-decoration:none;transition:all .2s" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">← Prev</a>
            @endif

            {{-- Page Numbers --}}
            @foreach($siswa->getUrlRange(max(1, $siswa->currentPage()-2), min($siswa->lastPage(), $siswa->currentPage()+2)) as $page => $url)
                @if($page == $siswa->currentPage())
                    <span style="padding:6px 12px;border-radius:6px;background:var(--accent);color:white;font-size:13px;font-weight:600">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:6px 12px;border-radius:6px;border:1px solid #e2e8f0;font-size:13px;color:var(--text-primary);text-decoration:none;transition:all .2s" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if($siswa->hasMorePages())
                <a href="{{ $siswa->nextPageUrl() }}" style="padding:6px 12px;border-radius:6px;border:1px solid #e2e8f0;font-size:13px;color:var(--text-primary);text-decoration:none;transition:all .2s" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">Next →</a>
            @else
                <span style="padding:6px 12px;border-radius:6px;border:1px solid #e2e8f0;font-size:13px;color:#cbd5e1;cursor:not-allowed">Next →</span>
            @endif
        </div>
    </div>
    @endif
</div>

@endsection