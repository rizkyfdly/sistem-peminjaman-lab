<h1>Detail Peminjaman</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<p><b>Kode:</b> {{ $peminjaman->kode_transaksi }}</p>
<p><b>User:</b> {{ $peminjaman->user->nama }}</p>
<p><b>Status:</b> {{ $peminjaman->status }}</p>

<h3>Barang:</h3>
<ul>
    @foreach($peminjaman->detail as $d)
        <li>{{ $d->barang->nama_barang }} - {{ $d->jumlah }}</li>
    @endforeach
</ul>

<br>

<form action="/peminjaman/{{ $peminjaman->id }}/approve" method="POST">
    @csrf
    <button type="submit">Approve</button>
</form>

<form action="/peminjaman/{{ $peminjaman->id }}/pinjam" method="POST">
    @csrf
    <button type="submit">Pinjam</button>
</form>

<form action="/peminjaman/{{ $peminjaman->id }}/kembali" method="POST">
    @csrf
    <input type="text" name="kondisi" placeholder="kondisi (baik/rusak ringan/dll)">
    <button type="submit">Kembalikan</button>
</form>

<br>

<a href="/peminjaman">Kembali</a>