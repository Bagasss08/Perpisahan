<!DOCTYPE html>
<html>
<head>
    <title>Hasil Kelulusan</title>
</head>
<body>

<h1>Hasil Kelulusan</h1>

<p>Nama: {{ $siswa->nama }}</p>

<p>NISN: {{ $siswa->nisn }}</p>

<p>Tanggal Lahir: {{ $siswa->tanggal_lahir }}</p>

<p>Status: {{ $siswa->status }}</p>

<br>

<a href="/">Kembali</a>

</body>
</html>