<h1>Data Peminjaman</h1>

@if(auth()->user()->role == 'user')
    <a href="/peminjaman/create">+ Tambah Peminjaman</a>
@endif

<table border="1">
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
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->status }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>

            <!-- USER -->
            @if(auth()->user()->role == 'user')
                <a href="/peminjaman/{{ $p->id }}">Detail</a>
            @endif

            <!-- ADMIN -->
            @if(auth()->user()->role == 'admin')
                <form action="/peminjaman/{{ $p->id }}/approve" method="POST">
                    @csrf
                    <button type="submit">Approve</button>
                </form>

                <form action="/peminjaman/{{ $p->id }}/pinjam" method="POST">
                    @csrf
                    <button type="submit">Pinjam</button>
                </form>
            @endif

        </td>
    </tr>
    @endforeach
</table>