@extends('admin.layouts.app')

@section('content')

<h3 class="mb-4">Edit Siswa</h3>

<form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nama Siswa</label>

        <input type="text"
               name="nama"
               value="{{ old('nama', $siswa->nama) }}"
               class="form-control">

        @error('nama')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">NISN</label>

        <input type="text"
               name="nisn"
               value="{{ old('nisn', $siswa->nisn) }}"
               class="form-control">

        @error('nisn')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>

        <input type="date"
               name="tanggal_lahir"
               value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
               class="form-control">

        @error('tanggal_lahir')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Wali Kelas</label>

        <select name="wali_kelas_id" class="form-control">
            <option value="">
                -- Pilih Wali Kelas --
            </option>

            @foreach($waliKelas as $wali)

                <option value="{{ $wali->id }}"
                    {{ $siswa->wali_kelas_id == $wali->id ? 'selected' : '' }}>

                    {{ $wali->nama_wali }} - {{ $wali->nama_kelas }}

                </option>

            @endforeach
        </select>

        @error('wali_kelas_id')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label">Status Kelulusan</label>

        <select name="status" class="form-control">

            <option value="LULUS"
                {{ $siswa->status == 'LULUS' ? 'selected' : '' }}>
                LULUS
            </option>

            <option value="TIDAK LULUS"
                {{ $siswa->status == 'TIDAK LULUS' ? 'selected' : '' }}>
                TIDAK LULUS
            </option>

        </select>

        @error('status')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <button class="btn btn-primary">
        Update Data
    </button>

    <a href="{{ route('admin.siswa.index') }}"
       class="btn btn-secondary">

        Kembali

    </a>

</form>

@endsection