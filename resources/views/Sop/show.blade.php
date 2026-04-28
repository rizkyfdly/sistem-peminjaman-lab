<h1>Detail SOP Barang</h1>

<p><b>Nama Barang:</b> {{ $barang->nama_barang }}</p>

<h3>Daftar SOP:</h3>

<ul>
    @foreach($sop as $s)
        <li>{{ $s->isi_sop }}</li>
    @endforeach
</ul>

<a href="/sop">Kembali</a>