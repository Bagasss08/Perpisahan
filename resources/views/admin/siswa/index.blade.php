@extends('admin.layouts.app')

@section('content')

<a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">
    Tambah Siswa
</a>

<table class="table table-bordered">

    <tr>
        <th>Nama</th>
        <th>NISN</th>
        <th>Wali Kelas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($siswas as $siswa)

    <tr>
        <td>{{ $siswa->nama }}</td>
        <td>{{ $siswa->nisn }}</td>
        <td>{{ $siswa->waliKelas->nama_wali ?? '-' }}</td>
        <td>{{ $siswa->status }}</td>

        <td>

            <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
               class="btn btn-warning btn-sm">
               Edit
            </a>

            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}"
                  method="POST"
                  class="d-inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">
                    Hapus
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection