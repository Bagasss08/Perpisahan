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

<!-- Content Grid -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

    <!-- Recent Siswa -->
    <div class="card" style="grid-column:1/-1">
        <div class="card-header" style="padding-bottom:16px">
            <div>
                <div class="card-title">Siswa Terbaru</div>
                <div class="card-subtitle">8 data siswa terakhir ditambahkan</div>
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
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Tanggal Lahir</th>
                        <th>Kelas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSiswa as $siswa)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                <div style="width:32px;height:32px;background:linear-gradient(135deg,#10b981,#6366f1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:white;flex-shrink:0">
                                    {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                </div>
                                <span class="fw-600">{{ $siswa->nama }}</span>
                            </div>
                        </td>
                        <td><span class="font-mono text-muted">{{ $siswa->nisn }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMM Y') }}</td>
                        <td>{{ $siswa->waliKelas?->nama_kelas ?? '<span class="text-muted">—</span>' }}</td>
                        <td>
                            @php
                                $badges = ['aktif'=>'badge-green','tidak_aktif'=>'badge-gray','lulus'=>'badge-blue','keluar'=>'badge-red'];
                                $dots = ['aktif'=>'badge-dot-green','tidak_aktif'=>'badge-dot-gray','lulus'=>'badge-dot-blue','keluar'=>'badge-dot-red'];
                                $labels = ['aktif'=>'Aktif','tidak_aktif'=>'Tidak Aktif','lulus'=>'Lulus','keluar'=>'Keluar'];
                            @endphp
                            <span class="badge {{ $badges[$siswa->status] ?? 'badge-gray' }}">
                                <span class="badge-dot {{ $dots[$siswa->status] ?? 'badge-dot-gray' }}"></span>
                                {{ $labels[$siswa->status] ?? $siswa->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
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
    </div>

    <!-- Wali Kelas Summary -->
    <div class="card" style="grid-column:1/-1">
        <div class="card-header" style="padding-bottom:16px">
            <div>
                <div class="card-title">Ringkasan Kelas</div>
                <div class="card-subtitle">Jumlah siswa per wali kelas</div>
            </div>
            <a href="{{ route('admin.wali-kelas.index') }}" class="btn btn-secondary btn-sm">
                Kelola Kelas
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="divider"></div>
        <div class="card-body">
            @forelse($waliKelasData as $wk)
            <div style="display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid #f1f5f9">
                <div style="width:40px;height:40px;background:#f0fdf4;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#10b981" stroke-width="2" style="width:20px;height:20px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div style="flex:1;min-width:0">
                    <div style="font-weight:600;font-size:14px;color:var(--text-primary)">{{ $wk->nama_kelas }}</div>
                    <div style="font-size:12.5px;color:var(--text-muted)">Wali: {{ $wk->nama_wali }}</div>
                </div>
                <div style="text-align:right">
                    <div style="font-size:18px;font-weight:800;color:var(--accent)">{{ $wk->siswas_count }}</div>
                    <div style="font-size:11px;color:var(--text-muted)">siswa</div>
                </div>
                <div style="width:120px">
                    @php $pct = $stats['total_siswa'] > 0 ? ($wk->siswas_count / $stats['total_siswa']) * 100 : 0; @endphp
                    <div style="height:6px;background:#f1f5f9;border-radius:999px;overflow:hidden">
                        <div style="height:100%;width:{{ round($pct) }}%;background:linear-gradient(90deg,#10b981,#059669);border-radius:999px;transition:width .5s ease"></div>
                    </div>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:3px;text-align:right">{{ round($pct) }}%</div>
                </div>
            </div>
            @empty
            <div class="empty-state" style="padding:24px">
                <div class="empty-state-desc">Belum ada wali kelas</div>
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection