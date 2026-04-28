<!DOCTYPE html>
<html>
<head>
    <title>Detail Peminjaman</title>
</head>
<body>

<h2>📄 Detail Peminjaman</h2>

<h3>Informasi Transaksi</h3>
<p><b>Kode:</b> {{ $peminjaman->kode_transaksi }}</p>
<p><b>User:</b> {{ $peminjaman->user->name }}</p>
<p><b>Status:</b> {{ $peminjaman->status }}</p>
<p><b>Tanggal Pinjam:</b> {{ $peminjaman->tanggal_pinjam }}</p>

<hr>

<h3>📦 Daftar Barang</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
    </tr>

    @foreach($detail as $key => $d)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $d->barang->nama_barang }}</td>
        <td>{{ $d->jumlah }}</td>
    </tr>
    @endforeach
</table>

<br>

<!-- Admin bisa mengedit atau menghapus, user hanya melihat -->
@if(auth()->user()->role == 'admin')
    <a href="/detail-peminjaman/{{ $d->id }}/edit">Edit</a>
    <form action="/detail-peminjaman/{{ $d->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@endif

<a href="/detail-peminjaman">⬅ Kembali</a>

</body>
</html>