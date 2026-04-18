<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>

<h2>✏️ Edit Barang</h2>

<form action="/barang/{{ $barang->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Barang</label><br>
    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}"><br><br>

    <label>Kode Barang</label><br>
    <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}"><br><br>

    <label>Kategori</label><br>
    <select name="kategori">
        <option value="alat" {{ $barang->kategori == 'alat' ? 'selected' : '' }}>Alat</option>
        <option value="bahan" {{ $barang->kategori == 'bahan' ? 'selected' : '' }}>Bahan</option>
    </select><br><br>

    <label>Satuan</label><br>
    <select name="satuan">
        <option value="pcs" {{ $barang->satuan == 'pcs' ? 'selected' : '' }}>PCS</option>
        <option value="gram" {{ $barang->satuan == 'gram' ? 'selected' : '' }}>Gram</option>
        <option value="ml" {{ $barang->satuan == 'ml' ? 'selected' : '' }}>ML</option>
    </select><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="{{ $barang->stok }}"><br><br>

    <label>Kondisi</label><br>
    <input type="text" name="kondisi" value="{{ $barang->kondisi }}"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi" value="{{ $barang->lokasi }}"><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="/barang">Kembali</a>

</body>
</html>