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
        // kalau akses GET langsung ke /cek
        if ($request->isMethod('get')) {
            return redirect('/');
        }

        $request->validate([
            'nisn'          => ['required', 'digits:10'],
            'tanggal_lahir' => ['required', 'date'],
        ], [
            'nisn.required'          => 'NISN wajib diisi.',
            'nisn.digits'            => 'NISN harus terdiri dari 10 digit angka.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
        ]);

        $siswa = Siswa::where('nisn', $request->nisn)
                    ->whereDate('tanggal_lahir', $request->tanggal_lahir)
                    ->first();

        return view('kelulusan.hasil', compact('siswa'));
    }
}