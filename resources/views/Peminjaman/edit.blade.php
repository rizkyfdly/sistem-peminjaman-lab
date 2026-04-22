<h1>Edit Peminjaman</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="/peminjaman/{{ $peminjaman->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>User:</label>
    <select name="user_id">
        @foreach($users as $u)
            <option value="{{ $u->id }}"
                {{ $peminjaman->user_id == $u->id ? 'selected' : '' }}>
                {{ $u->nama }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Status:</label>
    <select name="status">
        <option value="diajukan" {{ $peminjaman->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
        <option value="disetujui" {{ $peminjaman->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
        <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
        <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
    </select>

    <br><br>

    <h3>Detail Barang</h3>
    <ul>
        @foreach($peminjaman->detail as $d)
            <li>{{ $d->barang->nama_barang }} - {{ $d->jumlah }}</li>
        @endforeach
    </ul>

    <br>

    <button type="submit">Update</button>
</form>

<a href="/peminjaman">Kembali</a>