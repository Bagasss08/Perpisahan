<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\WaliKelas;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa'      => Siswa::count(),
            'siswa_aktif'      => Siswa::where('status', 'aktif')->count(),
            'siswa_lulus'      => Siswa::where('status', 'lulus')->count(),
            'total_wali_kelas' => WaliKelas::count(),
        ];

        $siswa = Siswa::with('waliKelas')
            ->orderBy('id', 'asc')
            ->paginate(20);

        $waliKelasData = WaliKelas::withCount('siswas')->get();

        return view('admin.dashboard', compact(
            'stats',
            'siswa',
            'waliKelasData'
        ));
    }
}