<!DOCTYPE html>
<html>
<head>
    <title>Edit SOP</title>
</head>
<body>

<h2>✏️ Edit SOP</h2>

<form action="/sop/{{ $sop->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Pilih Barang</label><br>
    <select name="barang_id">
        @foreach($barang as $b)
            <option value="{{ $b->id }}" {{ $sop->barang_id == $b->id ? 'selected' : '' }}>
                {{ $b->nama_barang }}
            </option>
        @endforeach
    </select><br><br>

    <label>Isi SOP</label><br>
    <textarea name="isi_sop" rows="5" cols="40">{{ $sop->isi_sop }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="/sop">Kembali</a>

</body>
</html>