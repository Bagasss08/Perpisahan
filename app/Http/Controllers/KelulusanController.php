<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class KelulusanController extends Controller
{
    public function index()
    {
        return view('kelulusan.index');
    }

    public function cek(Request $request)
{
    $request->validate([
        'nisn'          => ['required', 'digits:10'],
        'tanggal_lahir' => ['required', 'date'],
    ]);

    $siswa = Siswa::where('nisn', $request->nisn)
        ->whereDate('tanggal_lahir', $request->tanggal_lahir)
        ->first();

    if (!$siswa) {
        return back()->with('error', 'Data siswa tidak ditemukan.');
    }

    return view('kelulusan.hasil', compact('siswa'));
}
}