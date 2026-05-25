@extends('admin.layouts.app')

@section('title', 'Wali Kelas')
@section('page-title', 'Data Wali Kelas')
@section('breadcrumb', 'Wali Kelas')

@section('content')

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Daftar Wali Kelas</div>
            <div class="card-subtitle">Semua data wali kelas</div>
        </div>

        <a href="{{ route('admin.wali-kelas.create') }}" class="btn btn-primary">
            + Tambah Wali Kelas
        </a>
    </div>

    <div class="divider"></div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Wali</th>
                    <th>Nama Kelas</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($waliKelas as $index => $wk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $wk->nama_wali }}</td>
                    <td>{{ $wk->nama_kelas }}</td>
                    <td>{{ $wk->siswas()->count() }}</td>
                    <td style="display:flex;gap:8px">
                        <a href="{{ route('admin.wali-kelas.edit', $wk->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.wali-kelas.destroy', $wk->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:20px">
                        Belum ada data wali kelas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection