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

        $siswa = Siswa::where('nisn', trim($request->nisn))
            ->whereDate('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$siswa) {

            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        return view('kelulusan.hasil', compact('siswa'));
    }
}