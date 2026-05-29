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
    if ($request->isMethod('get')) {
        return view('kelulusan.index');
    }

    $request->validate([
        'nisn' => 'required',
        'tanggal_lahir' => 'required',
    ]);

    $nisn = trim($request->nisn);
    $tanggal = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');

    // DEBUG SEMENTARA
    $siswa = Siswa::where('nisn', $nisn)->first();
    dd([
        'nisn_input' => $nisn,
        'tanggal_input' => $tanggal,
        'siswa_ditemukan' => $siswa ? $siswa->toArray() : 'TIDAK ADA',
    ]);
}
}