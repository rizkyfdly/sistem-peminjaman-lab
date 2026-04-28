<!DOCTYPE html>
<html>
<head>
    <title>Tambah SOP Barang</title>
</head>
<body>

<h2>➕ Tambah SOP Barang</h2>

<form action="{{ route('sop.store') }}" method="POST">
    @csrf

    <label>Barang:</label>
    <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>
        @foreach($barang as $b)
            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Isi SOP:</label>
    <textarea name="isi_sop" required></textarea>

    <br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>