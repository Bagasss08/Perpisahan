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
            'nisn' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $nisn = trim($request->nisn);

        $siswa = Siswa::where('nisn', $nisn)
            ->whereDate('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$siswa) {
            return redirect('/')
                ->with('error', 'Data siswa tidak ditemukan');
        }

        return view('kelulusan.hasil', compact('siswa'));
    }
}