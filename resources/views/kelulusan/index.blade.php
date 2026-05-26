<!DOCTYPE html>
<html>
<head>
    <title>Cek Kelulusan</title>
</head>
<body>

    <h1>Cek Kelulusan</h1>

    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('cek.kelulusan') }}" method="POST">
        @csrf

        <div>
            <label>NISN</label>
            <input
                type="text"
                name="nisn"
                maxlength="10"
                value="{{ old('nisn') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Tanggal Lahir</label>
            <input
                type="date"
                name="tanggal_lahir"
                value="{{ old('tanggal_lahir') }}"
                required
            >
        </div>

        <br>

        <button type="submit">
            Cek Kelulusan
        </button>

    </form>

</body>
</html>