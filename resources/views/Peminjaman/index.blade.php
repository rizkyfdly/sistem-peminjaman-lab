<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
</head>
<body>

<h1>📋 Data Peminjaman</h1>

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

{{-- USER --}}
@if(auth()->user()->role == 'user')

    <a href="/peminjaman/create">
        + Tambah Peminjaman
    </a>

@endif

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>User</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @foreach($peminjaman as $key => $p)

    <tr>

        <td>{{ $key + 1 }}</td>

        <td>
            {{ $p->kode_transaksi }}
        </td>

        <td>
            {{ $p->user->name }}
        </td>

        <td>

            {{-- STATUS DIAJUKAN --}}
            @if($p->status == 'diajukan')

                <span style="color:orange">
                    Diajukan
                </span>

            {{-- STATUS DIPINJAM --}}
            @elseif($p->status == 'dipinjam')

                <span style="color:blue">
                    Dipinjam
                </span>

            {{-- STATUS MENUNGGU VERIFIKASI --}}
            @elseif($p->status == 'menunggu_verifikasi')

                <span style="color:purple">
                    Menunggu Verifikasi
                </span>

            {{-- STATUS DIKEMBALIKAN --}}
            @elseif($p->status == 'dikembalikan')

                <span style="color:green">
                    Dikembalikan
                </span>

            @endif

        </td>

        <td>
            {{ $p->tanggal_pinjam }}
        </td>

        <td>

            {{-- DETAIL --}}
            <a href="/peminjaman/{{ $p->id }}">
                Detail
            </a>

            <br><br>

            {{-- ========================================= --}}
            {{-- USER --}}
            {{-- ========================================= --}}
            @if(auth()->user()->role == 'user')

                {{-- AJUKAN PENGEMBALIAN --}}
                @if($p->status == 'dipinjam')

                    <form action="{{ route('peminjaman.ajukanPengembalian', $p->id) }}"
                          method="POST">

                        @csrf

                        <select name="kondisi" required>

                            <option value="">
                                Pilih Kondisi
                            </option>

                            <option value="baik">
                                Baik
                            </option>

                            <option value="rusak ringan">
                                Rusak Ringan
                            </option>

                            <option value="rusak berat">
                                Rusak Berat
                            </option>

                            <option value="hilang">
                                Hilang
                            </option>

                        </select>

                        <br><br>

                        <button type="submit">
                            Ajukan Pengembalian
                        </button>

                    </form>

                @endif

            @endif


            {{-- ========================================= --}}
            {{-- ADMIN --}}
            {{-- ========================================= --}}
            @if(auth()->user()->role == 'admin')

                {{-- APPROVE --}}
                @if($p->status == 'diajukan')

                    <form action="{{ route('admin.peminjaman.approve', $p->id) }}"
                          method="POST"
                          style="display:inline;">

                        @csrf

                        <button type="submit">
                            Approve
                        </button>

                    </form>

                    <br><br>

                    {{-- HAPUS --}}
                    <form action="{{ route('admin.peminjaman.destroy', $p->id) }}"
                          method="POST"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus?')">

                            Hapus

                        </button>

                    </form>

                @endif


                {{-- VERIFIKASI --}}
                @if($p->status == 'menunggu_verifikasi')

                    {{-- TAMPILKAN KONDISI DARI USER --}}
                    <p>

                        <b>Kondisi User:</b>

                        {{ $p->kondisi_kembali }}

                    </p>

                    <form action="{{ route('admin.peminjaman.kembali', $p->id) }}"
                          method="POST">

                        @csrf

                        {{-- CATATAN ADMIN --}}
                        <textarea name="catatan_admin"
                                  placeholder="Tindakan / catatan admin"
                                  rows="3"
                                  cols="30"></textarea>

                        <br><br>

                        <button type="submit">
                            Verifikasi
                        </button>

                    </form>

                @endif


                {{-- DATA SELESAI --}}
                @if($p->status == 'dikembalikan')

                    <p>

                        <b>Kondisi:</b>

                        {{ $p->kondisi_kembali }}

                    </p>

                    <p>

                        <b>Denda:</b>

                        Rp {{ number_format($p->denda, 0, ',', '.') }}

                    </p>

                    @if($p->catatan_admin)

                        <p>

                            <b>Catatan Admin:</b>

                            {{ $p->catatan_admin }}

                        </p>

                    @endif

                @endif

            @endif

        </td>

    </tr>

    @endforeach

</table>

</body>
</html>