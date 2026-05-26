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
    // Jika akses GET langsung ke /cek
    if ($request->isMethod('get')) {
        return redirect('/');
    }

    $request->validate([
        'nisn'          => ['required', 'digits:10'],
        'tanggal_lahir' => ['required', 'date'],
    ]);

    $siswa = Siswa::where('nisn', $request->nisn)
        ->whereDate('tanggal_lahir', $request->tanggal_lahir)
        ->first();

    if (!$siswa) {
        return back()->withErrors([
            'nisn' => 'Data siswa tidak ditemukan.'
        ])->withInput();
    }

    return view('kelulusan.hasil', compact('siswa'));
}
}