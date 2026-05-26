<!DOCTYPE html>
<html>
<head>
    <title>Detail Peminjaman</title>
</head>
<body>

<h1>📋 Detail Peminjaman</h1>

<br>

<p>
    <strong>Kode Transaksi:</strong>
    {{ $peminjaman->kode_transaksi }}
</p>

<p>
    <strong>User:</strong>
    {{ $peminjaman->user->name }}
</p>

<p>
    <strong>Status:</strong>

    @if($peminjaman->status == 'diajukan')

        <span style="color:orange">
            Diajukan
        </span>

    @elseif($peminjaman->status == 'dipinjam')

        <span style="color:blue">
            Dipinjam
        </span>

    @elseif($peminjaman->status == 'menunggu_verifikasi')

        <span style="color:purple">
            Menunggu Verifikasi
        </span>

    @elseif($peminjaman->status == 'dikembalikan')

        <span style="color:green">
            Dikembalikan
        </span>

    @endif

</p>

<p>
    <strong>Tanggal Pinjam:</strong>
    {{ $peminjaman->tanggal_pinjam }}
</p>

<hr>

<h3>📦 Daftar Barang</h3>

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
        </tr>
    </thead>

    <tbody>

        @foreach($peminjaman->detail as $key => $d)

        <tr>

            <td>
                {{ $key + 1 }}
            </td>

            <td>
                {{ $d->barang->nama_barang }}
            </td>

            <td>
                {{ $d->jumlah }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<br>

<a href="/peminjaman">
    ← Kembali
</a>

</body>
</html>