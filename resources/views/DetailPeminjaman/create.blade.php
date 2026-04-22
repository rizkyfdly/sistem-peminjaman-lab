<!DOCTYPE html>
<html>
<head>
    <title>Tambah SOP</title>
</head>
<body>

<h2>➕ Tambah SOP Barang</h2>

<form action="/sop" method="POST">
    @csrf

    <label>Pilih Barang</label><br>
    <select name="barang_id">
        @foreach($barang as $b)
            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select><br><br>

    <label>Isi SOP</label><br>
    <textarea name="isi_sop" rows="5" cols="40"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="/sop">Kembali</a>

</body>
</html>