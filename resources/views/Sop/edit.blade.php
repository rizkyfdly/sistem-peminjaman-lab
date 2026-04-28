<h1>Edit SOP</h1>

<form method="POST" action="{{ route('sop.update', $sop->id) }}">
@csrf
@method('PUT')

<select name="barang_id">
    @foreach($barang as $b)
        <option value="{{ $b->id }}" {{ $sop->barang_id == $b->id ? 'selected' : '' }}>
            {{ $b->nama }}
        </option>
    @endforeach
</select>

<input type="text" name="judul" value="{{ $sop->judul }}">
<textarea name="deskripsi">{{ $sop->deskripsi }}</textarea>

<button type="submit">Update</button>
</form>