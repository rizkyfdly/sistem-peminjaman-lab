<!DOCTYPE html>
<html>
<head>
    <title>Detail Peminjaman</title>
</head>
<body>

<h2>📋 Detail Peminjaman</h2>

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif

@if(session('error'))
    <p style="color:red">
        {{ session('error') }}
    </p>
@endif

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Barang</th>
            <th>Jumlah</th>

            @if(auth()->user()->role == 'admin')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>

    <tbody>

        @foreach($detail as $key => $d)

        <tr>

            <td>{{ $key + 1 }}</td>

            <td>
                {{ $d->peminjaman->kode_transaksi }}
            </td>

            <td>
                {{ $d->barang->nama_barang }}
            </td>

            <td>
                {{ $d->jumlah }}
            </td>

            @if(auth()->user()->role == 'admin')

            <td>

                {{-- EDIT --}}
                <a href="{{ route('admin.detail-peminjaman.edit', $d->id) }}">
                    Edit
                </a>

                {{-- HAPUS --}}
                <form action="{{ route('admin.detail-peminjaman.destroy', $d->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>

                </form>

            </td>

            @endif

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>