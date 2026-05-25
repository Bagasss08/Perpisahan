@extends('admin.layouts.app')

@section('title', 'Tambah Wali Kelas')

@section('content')

<div class="card p-4">

    <h2 class="mb-4">Tambah Wali Kelas</h2>

    <form action="{{ route('admin.wali-kelas.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">
                Nama Wali Kelas
            </label>

            <input type="text"
                   name="nama_wali"
                   class="form-control"
                   value="{{ old('nama_wali') }}"
                   placeholder="Masukkan nama wali kelas"
                   required>

            @error('nama_wali')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">
                Nama Kelas
            </label>

            <input type="text"
                   name="nama_kelas"
                   class="form-control"
                   value="{{ old('nama_kelas') }}"
                   placeholder="Contoh: XII RPL 1"
                   required>

            @error('nama_kelas')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">
                Komentar / Ucapan
            </label>

            <textarea name="komentar"
                      rows="5"
                      class="form-control"
                      placeholder="Masukkan komentar atau ucapan untuk siswa...">{{ old('komentar') }}</textarea>

            @error('komentar')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Data
        </button>

        <a href="{{ route('admin.wali-kelas.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </form>

</div>

@endsection