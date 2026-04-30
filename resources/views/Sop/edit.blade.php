<h2>Edit SOP</h2>

<form action="{{ route('sop.update', $sop->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Pilih Barang -->
    <label>Barang</label>
    <select name="barang_id">
        @foreach($barang as $b)
            <option value="{{ $b->id }}" 
                {{ $sop->barang_id == $b->id ? 'selected' : '' }}>
                {{ $b->nama_barang }}
            </option>
        @endforeach
    </select>

    <br><br>

    <!-- Isi SOP -->
    <label>Isi SOP</label>
    <textarea name="isi_sop">{{ $sop->isi_sop }}</textarea>

    <br><br>

    <button type="submit">Update</button>
</form>