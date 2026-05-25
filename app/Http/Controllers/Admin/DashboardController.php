<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\WaliKelas;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => Siswa::count(),

            'siswa_aktif' => Siswa::where('status', 'aktif')->count(),

            'siswa_lulus' => Siswa::where('status', 'lulus')->count(),

            'total_wali_kelas' => WaliKelas::count(),
        ];

        $recentSiswa = Siswa::latest()
            ->take(8)
            ->get();

        $waliKelasData = WaliKelas::withCount('siswas')->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentSiswa',
            'waliKelasData'
        ));
    }
}