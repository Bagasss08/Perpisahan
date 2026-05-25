@extends('admin.layouts.app')

@section('content')

<h3>Tambah Siswa</h3>

<form action="{{ route('admin.siswa.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="mb-3">
        <label>NISN</label>
        <input type="text" name="nisn" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control">
    </div>

    <div class="mb-3">
        <label>Wali Kelas</label>

        <select name="wali_kelas_id" class="form-control">

            @foreach($waliKelas as $wk)

                <option value="{{ $wk->id }}">
                    {{ $wk->nama_wali }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>

        <select name="status" class="form-control">
            <option value="LULUS">LULUS</option>
            <option value="TIDAK LULUS">TIDAK LULUS</option>
        </select>
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

@endsection