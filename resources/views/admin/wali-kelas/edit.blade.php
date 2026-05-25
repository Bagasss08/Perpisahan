@extends('admin.layouts.app')

@section('title', 'Edit Wali Kelas')

@section('content')

<div class="card">

    <h2>Edit Wali Kelas</h2>

    <form action="{{ route('admin.wali-kelas.update', $waliKelas->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Wali</label>

            <input type="text"
                   name="nama_wali"
                   value="{{ $waliKelas->nama_wali }}"
                   class="form-control"
                   required>
        </div>

        <div class="form-group">
            <label>Nama Kelas</label>

            <input type="text"
                   name="nama_kelas"
                   value="{{ $waliKelas->nama_kelas }}"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary">
            Update
        </button>

    </form>

</div>

@endsection