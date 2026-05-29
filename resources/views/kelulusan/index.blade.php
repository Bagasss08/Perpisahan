<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kelulusan</title>
</head>
<body>

    @if(session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('cek.kelulusan') }}">

        @csrf

        <div>
            <label>NISN</label>
            <br>
            <input
                type="text"
                name="nisn"
                inputmode="numeric"
                autocomplete="off"
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
                required
            >
        </div>

        <br>

        <button type="submit">Cek Kelulusan</button>

    </form>

</body>
</html>