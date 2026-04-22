<h1>Edit SOP</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="/sop/{{ $sop->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Barang:</label>
    <select name="barang_id" disabled>
        @foreach($barang as $b)
            <option value="{{ $b->id }}"
                {{ $sop->barang_id == $b->id ? 'selected' : '' }}>
                {{ $b->nama_barang }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Isi SOP:</label><br>
    <textarea name="isi_sop" rows="5" cols="50">{{ $sop->isi_sop }}</textarea>

    <br><br>

    <button type="submit">Update</button>
</form>

<a href="/sop">Kembali</a>