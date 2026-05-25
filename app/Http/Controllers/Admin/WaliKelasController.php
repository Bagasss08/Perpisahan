<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function index()
    {
        $waliKelas = WaliKelas::latest()->get();

        return view('admin.wali-kelas.index', compact('waliKelas'));
    }

    public function create()
    {
        return view('admin.wali-kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required',
            'nama_kelas' => 'required',
            'komentar' => 'nullable'
        ]);

        WaliKelas::create($request->all());

        return redirect()
            ->route('admin.wali-kelas.index')
            ->with('success', 'Wali kelas berhasil ditambahkan');
    }

    public function edit(WaliKelas $wali_kela)
    {
        return view('admin.wali-kelas.edit', [
            'waliKelas' => $wali_kela
        ]);
    }

    public function update(Request $request, WaliKelas $wali_kela)
    {
        $request->validate([
            'nama_wali' => 'required',
            'nama_kelas' => 'required',
        ]);

        $wali_kela->update($request->all());

        return redirect()
            ->route('admin.wali-kelas.index')
            ->with('success', 'Wali kelas berhasil diupdate');
    }

    public function destroy(WaliKelas $wali_kela)
    {
        $wali_kela->delete();

        return redirect()
            ->route('admin.wali-kelas.index')
            ->with('success', 'Wali kelas berhasil dihapus');
    }
}