<!DOCTYPE html>
<html>
<head>
    <title>Data SOP Barang</title>
</head>
<body>

<h2>📘 Data SOP Barang</h2>

<a href="/sop/create">+ Tambah SOP</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Isi SOP</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sop as $key => $s)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $s->barang->nama_barang }}</td>
            <td>{{ $s->isi_sop }}</td>
            <td>
                <a href="/sop/{{ $s->id }}/edit">Edit</a>

                <form action="/sop/{{ $s->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus SOP?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

</body>
</html>