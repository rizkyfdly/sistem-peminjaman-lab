<h1>Data SOP Barang</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="/sop/create">+ Tambah SOP</a>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>SOP</th>
        <th>Aksi</th>
    </tr>

    @foreach($sop as $key => $s)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $s->barang->nama_barang }}</td>
        <td>{{ $s->isi_sop }}</td>
        <td>
            <a href="/sop/{{ $s->barang_id }}">Detail</a> |
            <a href="/sop/{{ $s->id }}/edit">Edit</a> |
            <form action="/sop/{{ $s->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>