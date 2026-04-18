<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>

<h2>📦 Data Barang</h2>

<a href="/barang/create">+ Tambah Barang</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($barang as $key => $b)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $b->nama_barang }}</td>
            <td>{{ $b->kode_barang }}</td>
            <td>{{ $b->kategori }}</td>
            <td>{{ $b->satuan }}</td>
            <td>{{ $b->stok }}</td>
            <td>{{ $b->kondisi }}</td>
            <td>{{ $b->lokasi }}</td>
            <td>
                <a href="/barang/{{ $b->id }}/edit">Edit</a>

                <form action="/barang/{{ $b->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus data?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

</body>
</html>