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
        $request->validate([
            'nisn' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $nisn = trim($request->nisn);

        // normalisasi tanggal
        $tanggal = Carbon::parse($request->tanggal_lahir)
            ->format('Y-m-d');

        $siswa = Siswa::where('nisn', $nisn)
            ->where('tanggal_lahir', $tanggal)
            ->first();

        if (!$siswa) {
            return redirect('/')
                ->with('error', 'Data siswa tidak ditemukan');
        }

        return view('kelulusan.hasil', compact('siswa'));
    }
}