<!DOCTYPE html>
<html>
<head>
    <title>Detail SOP</title>
</head>
<body>

<h2>📘 SOP untuk: {{ $barang->nama_barang }}</h2>

@foreach($sop as $s)
    <p>- {{ $s->isi_sop }}</p>
@endforeach

<br>
<a href="/sop">Kembali</a>

</body>
</html>