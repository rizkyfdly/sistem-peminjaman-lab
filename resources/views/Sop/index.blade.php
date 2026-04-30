<!-- resources/views/sop/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Daftar SOP Barang</title>
</head>
<body>

<h2>📜 Daftar SOP Barang</h2>

{{-- HANYA ADMIN --}}
@if(auth()->check() && auth()->user()->role == 'admin')
    <a href="{{ route('sop.create') }}">+ Tambah SOP Barang</a>
@endif

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>SOP Barang</th>

            {{-- Kolom Aksi hanya untuk admin --}}
            @if(auth()->check() && auth()->user()->role == 'admin')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach($sop as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>

                <td>
                    {{ $item->barang ? $item->barang->nama_barang : 'Barang tidak ditemukan' }}
                </td>

                <td>{{ $item->isi_sop }}</td>

                {{-- Aksi hanya untuk admin --}}
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <td>
                        <a href="{{ route('sop.edit', $item->id) }}">Edit</a>

                        <form action="{{ route('sop.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>