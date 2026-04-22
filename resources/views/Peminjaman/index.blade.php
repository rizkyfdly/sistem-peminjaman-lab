<h1>Data Peminjaman</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="/peminjaman/create">+ Tambah Peminjaman</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Kode</th>
        <th>User</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @foreach($peminjaman as $p)
    <tr>
        <td>{{ $p->kode_transaksi }}</td>
        <td>{{ $p->user->nama ?? '-' }}</td>
        <td>{{ $p->status }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>
            <a href="/peminjaman/{{ $p->id }}">Detail</a> |
            <a href="/peminjaman/{{ $p->id }}/edit">Edit</a>
        </td>
    </tr>
    @endforeach
</table>