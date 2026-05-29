<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Carbon\Carbon;

class KelulusanController extends Controller
{
    public function index()
    {
        return view('kelulusan.index');
    }

    public function cek(Request $request)
    {
        // kalau akses GET langsung tampilkan form
        if ($request->isMethod('get')) {
            return view('kelulusan.index');
        }

        $request->validate([
            'nisn' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $nisn = trim($request->nisn);

        $tanggal = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');

        $siswa = Siswa::where('nisn', $nisn)
            ->whereDate('tanggal_lahir', $tanggal)
            ->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        return view('kelulusan.hasil', compact('siswa'));
    }
}