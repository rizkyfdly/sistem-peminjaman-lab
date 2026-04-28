<h1>Tambah Peminjaman</h1>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="/peminjaman" method="POST">
    @csrf

    <p>User: {{ auth()->user()->name }}</p>
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

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