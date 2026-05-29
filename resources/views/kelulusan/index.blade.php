<form method="POST" action="{{ url('/cek') }}">

    @csrf

    @if(session('error'))
    <div style="color: red; margin-bottom: 10px;">
        {{ session('error') }}
    </div>
@endif

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

    <input type="submit" value="Cek Kelulusan">

</form>