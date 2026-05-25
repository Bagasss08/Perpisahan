@extends('admin.layouts.app')

@section('title', 'Tambah Wali Kelas')

@section('content')

<div class="card">

    <h2>Tambah Wali Kelas</h2>

    <form action="{{ route('admin.wali-kelas.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Nama Wali</label>

            <input type="text"
                   name="nama_wali"
                   class="form-control"
                   required>
        </div>

        <div class="form-group">
            <label>Nama Kelas</label>

            <input type="text"
                   name="nama_kelas"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

    </form>

</div>

@endsection