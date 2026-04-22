<h1>Tambah Peminjaman</h1>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="/peminjaman" method="POST">
    @csrf

    <label>User:</label>
    <select name="user_id">
        @foreach($users as $u)
            <option value="{{ $u->id }}">{{ $u->nama }}</option>
        @endforeach
    </select>

    <br><br>

    <h3>Barang</h3>

    <div>
        <select name="barang[0][id]">
            @foreach($barang as $b)
                <option value="{{ $b->id }}">
                    {{ $b->nama_barang }} (stok: {{ $b->stok }})
                </option>
            @endforeach
        </select>

        <input type="number" name="barang[0][jumlah]" placeholder="Jumlah">
    </div>

    <br>

    <button type="submit">Simpan</button>
</form>

<a href="/peminjaman">Kembali</a>