<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Peminjaman</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #F5F9FF;
        }

        .page-title{

            color: #0B1F66;

            font-weight: 800;
        }

        .table-card{

            background: white;

            border-radius: 28px;

            padding: 30px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .table{

            vertical-align: middle;
        }

        .table th{

            color: #0B1F66;
        }

        .btn-main{

            background: #1565FF;

            color: white;

            border-radius: 12px;

            padding: 10px 20px;

            text-decoration: none;

            border: none;

            transition: 0.3s;
        }

        .btn-main:hover{

            background: #0B1F66;

            color: white;
        }

        .action-btn{

            width: 38px;

            height: 38px;

            border-radius: 10px;

            border: 1px solid #E5EAF5;

            background: white;

            color: #0B1F66;

            transition: 0.3s;

            margin-right: 5px;
        }

        .action-btn:hover{

            background: #1565FF;

            color: white;
        }

        .back-btn{

            text-decoration: none;

            color: #0B1F66;

            font-weight: 600;
        }

        .badge-status{

            padding: 8px 14px;

            border-radius: 12px;

            font-size: 13px;

            font-weight: 600;
        }

        .badge-diajukan{

            background: rgba(255,193,7,0.15);

            color: #FFC107;
        }

        .badge-dipinjam{

            background: rgba(13,110,253,0.15);

            color: #0D6EFD;
        }

        .badge-verifikasi{

            background: rgba(111,66,193,0.15);

            color: #6F42C1;
        }

        .badge-kembali{

            background: rgba(25,135,84,0.15);

            color: #198754;
        }

        .mini-card{

            background: #F8FAFF;

            border-radius: 16px;

            padding: 15px;

            margin-top: 12px;
        }

        textarea,
        select{

            border-radius: 12px !important;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <a href="{{ url('/dashboard') }}"
               class="back-btn">

                <i class="bi bi-arrow-left"></i>
                Kembali ke Dashboard

            </a>

            <h1 class="page-title mt-3">

                📋 Data Peminjaman

            </h1>

        </div>

        @if(auth()->user()->role == 'user')

            <a href="/peminjaman/create"
               class="btn-main">

                + Tambah Peminjaman

            </a>

        @endif

    </div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="alert alert-success rounded-4">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger rounded-4">

            {{ session('error') }}

        </div>

    @endif

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Kode</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($peminjaman as $key => $p)

                    <tr>

                        <td>{{ $key + 1 }}</td>

                        <td>

                            <strong>

                                {{ $p->kode_transaksi }}

                            </strong>

                        </td>

                        <td>{{ $p->user->name }}</td>

                        <td>

                            @if($p->status == 'diajukan')

                                <span class="badge-status badge-diajukan">

                                    Diajukan

                                </span>

                            @elseif($p->status == 'dipinjam')

                                <span class="badge-status badge-dipinjam">

                                    Dipinjam

                                </span>

                            @elseif($p->status == 'menunggu_verifikasi')

                                <span class="badge-status badge-verifikasi">

                                    Verifikasi

                                </span>

                            @elseif($p->status == 'dikembalikan')

                                <span class="badge-status badge-kembali">

                                    Dikembalikan

                                </span>

                            @endif

                        </td>

                        <td>{{ $p->tanggal_pinjam }}</td>

                        <td>

                            <!-- DETAIL -->
                        <div class="d-flex justify-content-center gap-2 mb-2">
                            <a href="/peminjaman/{{ $p->id }}"
                               class="btn action-btn">

                                <i class="bi bi-eye"></i>

                            </a>

                            @if(auth()->user()->role == 'user')

                                <!-- EDIT -->
                                <a href="/peminjaman/{{ $p->id }}/edit"
                                class="btn action-btn">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            @endif
                        </div>

                            <!-- ========================= -->
                            <!-- USER -->
                            <!-- ========================= -->
                            @if(auth()->user()->role == 'user')

                                @if($p->status == 'dipinjam')

                                    <div class="mini-card">

                                        <form action="{{ route('peminjaman.ajukanPengembalian', $p->id) }}"
                                              method="POST">

                                            @csrf

                                            <select name="kondisi"
                                                    class="form-select mb-3"
                                                    required>

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

                                            <button type="submit"
                                                    class="btn-main">

                                                Ajukan Pengembalian

                                            </button>

                                        </form>

                                    </div>

                                @endif

                            @endif

                            <!-- ========================= -->
                            <!-- ADMIN -->
                            <!-- ========================= -->
                            @if(auth()->user()->role == 'admin')

                                @if($p->status == 'diajukan')

                                    <div class="mt-2">

                                        <form action="{{ route('admin.peminjaman.approve', $p->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-success btn-sm rounded-3">

                                                Approve

                                            </button>

                                        </form>

                                        <form action="{{ route('admin.peminjaman.destroy', $p->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus?')"
                                                    class="btn btn-danger btn-sm rounded-3">

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                @endif

                                @if($p->status == 'menunggu_verifikasi')

                                    <div class="mini-card">

                                        <p>

                                            <strong>Kondisi User:</strong>

                                            {{ $p->kondisi_kembali }}

                                        </p>

                                        <form action="{{ route('admin.peminjaman.kembali', $p->id) }}"
                                              method="POST">

                                            @csrf

                                            <textarea name="catatan_admin"
                                                      class="form-control mb-3"
                                                      rows="3"
                                                      placeholder="Tindakan / catatan admin"></textarea>

                                            <button type="submit"
                                                    class="btn-main">

                                                Verifikasi

                                            </button>

                                        </form>

                                    </div>

                                @endif

                                @if($p->status == 'dikembalikan')

                                    <div class="mini-card">

                                        <p>

                                            <strong>Kondisi:</strong>

                                            {{ $p->kondisi_kembali }}

                                        </p>

                                        <p>

                                            <strong>Denda:</strong>

                                            Rp {{ number_format($p->denda, 0, ',', '.') }}

                                        </p>

                                        @if($p->catatan_admin)

                                            <p class="mb-0">

                                                <strong>Catatan:</strong>

                                                {{ $p->catatan_admin }}

                                            </p>

                                        @endif

                                    </div>

                                @endif

                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>