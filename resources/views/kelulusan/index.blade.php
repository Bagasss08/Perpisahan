<!DOCTYPE html>
<html>
<head>
    <title>Cek Kelulusan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <h1>Cek Kelulusan</h1>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('cek.kelulusan') }}" method="POST">

        @csrf

        <div>
            <label>NISN</label>
            <br>

            <input
                type="number"
                name="nisn"
                value="{{ old('nisn') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Tanggal Lahir</label>
            <br>

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