<h1>Tambah SOP</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="/sop" method="POST">
    @csrf

    <label>Barang:</label>
    <select name="barang_id">
        @foreach($barang as $b)
            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Isi SOP:</label><br>
    <textarea name="isi_sop" rows="5" cols="50"></textarea>

    <br><br>

    <button type="submit">Simpan</button>
</form>

<a href="/sop">Kembali</a>