<!DOCTYPE html>
<html>
<head>
    <title>Detail Peminjaman</title>
</head>
<body>

<h2>📋 Detail Peminjaman</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<!-- Hanya admin yang bisa mengakses tombol edit dan hapus -->
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($detail as $key => $d)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $d->peminjaman->kode_transaksi }}</td>
            <td>{{ $d->barang->nama_barang }}</td>
            <td>{{ $d->jumlah }}</td>
            
            @if(auth()->user()->role == 'admin')
                <!-- Admin bisa mengedit dan menghapus -->
                <td>
                    <a href="/detail-peminjaman/{{ $d->id }}/edit">Edit</a>
                    <form action="/detail-peminjaman/{{ $d->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            @else
                <!-- User hanya melihat -->
                <td>-</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>