<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('waliKelas')->latest()->get();

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $waliKelas = WaliKelas::all();

        return view('admin.siswa.create', compact('waliKelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:siswas,nisn',
            'tanggal_lahir' => 'required',
            'wali_kelas_id' => 'required',
            'status' => 'required'
        ]);

        Siswa::create($request->all());

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        $waliKelas = WaliKelas::all();

        return view('admin.siswa.edit', compact(
            'siswa',
            'waliKelas'
        ));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'tanggal_lahir' => 'required',
            'wali_kelas_id' => 'required',
            'status' => 'required'
        ]);

        $siswa->update($request->all());

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diupdate');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return back()->with('success', 'Data siswa dihapus');
    }
}