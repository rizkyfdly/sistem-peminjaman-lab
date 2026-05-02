<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
</head>
<body>

<h2>➕ Tambah Barang</h2>

<form action="{{ url('/admin/barang') }}" method="POST">
    @csrf

    <label>Nama Barang</label><br>
    <input type="text" name="nama_barang"><br><br>

    <label>Kode Barang</label><br>
    <input type="text" name="kode_barang"><br><br>

    <label>Kategori</label><br>
    <select name="kategori">
        <option value="alat">Alat</option>
        <option value="bahan">Bahan</option>
    </select><br><br>

    <label>Satuan</label><br>
    <select name="satuan">
        <option value="pcs">PCS</option>
        <option value="gram">Gram</option>
        <option value="ml">ML</option>
    </select><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok"><br><br>

    <label>Kondisi</label><br>
    <input type="text" name="kondisi"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi"><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ url('/admin/barang') }}">Kembali</a>

</body>
</html>