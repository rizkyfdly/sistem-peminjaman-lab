<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail Peminjaman</title>

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

        .detail-card{

            background: white;

            border-radius: 28px;

            padding: 35px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .info-box{

            background: #F8FAFF;

            border-radius: 18px;

            padding: 18px;
        }

        .info-title{

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 5px;
        }

        .info-value{

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

        .barang-card{

            background: white;

            border-radius: 22px;

            overflow: hidden;

            box-shadow: 0 5px 18px rgba(0,0,0,0.05);

            height: 100%;
        }

        .barang-image{

            width: 100%;

            height: 220px;

            object-fit: cover;
        }

        .barang-content{

            padding: 20px;
        }

        .barang-title{

            color: #0B1F66;

            font-weight: 700;
        }

        .jumlah-badge{

            background: rgba(21,101,255,0.1);

            color: #1565FF;

            padding: 8px 14px;

            border-radius: 12px;

            display: inline-block;

            font-weight: 600;
        }

        .back-btn{

            text-decoration: none;

            color: #0B1F66;

            font-weight: 600;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="mb-4">

        <a href="/peminjaman"
           class="back-btn">

            <i class="bi bi-arrow-left"></i>
            Kembali ke Data Peminjaman

        </a>

        <h1 class="page-title mt-3">

            📋 Detail Peminjaman

        </h1>

    </div>

    <!-- DETAIL -->
    <div class="detail-card mb-5">

        <div class="row g-4">

            <!-- KODE -->
            <div class="col-md-3">

                <div class="info-box">

                    <div class="info-title">

                        Kode Transaksi

                    </div>

                    <div class="info-value">

                        {{ $peminjaman->kode_transaksi }}

                    </div>

                </div>

            </div>

            <!-- USER -->
            <div class="col-md-3">

                <div class="info-box">

                    <div class="info-title">

                        User

                    </div>

                    <div class="info-value">

                        {{ $peminjaman->user->name }}

                    </div>

                </div>

            </div>

            <!-- STATUS -->
            <div class="col-md-3">

                <div class="info-box">

                    <div class="info-title">

                        Status

                    </div>

                    <div class="mt-2">

                        @if($peminjaman->status == 'diajukan')

                            <span class="badge-status badge-diajukan">

                                Diajukan

                            </span>

                        @elseif($peminjaman->status == 'dipinjam')

                            <span class="badge-status badge-dipinjam">

                                Dipinjam

                            </span>

                        @elseif($peminjaman->status == 'menunggu_verifikasi')

                            <span class="badge-status badge-verifikasi">

                                Verifikasi

                            </span>

                        @elseif($peminjaman->status == 'dikembalikan')

                            <span class="badge-status badge-kembali">

                                Dikembalikan

                            </span>

                        @endif

                    </div>

                </div>

            </div>

            <!-- TANGGAL -->
            <div class="col-md-3">

                <div class="info-box">

                    <div class="info-title">

                        Tanggal Pinjam

                    </div>

                    <div class="info-value">

                        {{ $peminjaman->tanggal_pinjam }}
                        <br>
                        {{substr($peminjaman->jam_pinjam, 0,5)}}
                    </div>

                </div>

            </div>
            <!-- TENGGAT PENGEMBALIAN -->
        <div class="col-md-3">

            <div class="info-box">

                 <div class="info-title">

                    Tenggat Pengembalian

                </div>

                 <div class="info-value text-danger">

                         {{ $peminjaman->tanggal_deadline }}

                 <br>

             {{ substr($peminjaman->jam_deadline, 0, 5) }}

        </div>

    </div>

</div>

        </div>

    </div>

    <!-- BARANG -->
    <h3 class="fw-bold mb-4">

        📦 Daftar Barang

    </h3>

    <div class="row g-4">

        @foreach($peminjaman->detail as $d)

        <div class="col-lg-4 col-md-6">

            <div class="barang-card">

                <!-- GAMBAR -->
                <img src="{{ asset('storage/'.$d->barang->gambar) }}"
                     class="barang-image">

                <div class="barang-content">

                    <h5 class="barang-title mb-3">

                        {{ $d->barang->nama_barang }}

                    </h5>

                    <div class="jumlah-badge mb-3">

                        Jumlah:
                        {{ $d->jumlah }}

                    </div>

                    <p class="text-secondary mb-2">

                        <strong>Kategori:</strong>
                        {{ $d->barang->kategori }}

                    </p>

                    <p class="text-secondary mb-2">

                        <strong>Kondisi:</strong>
                        {{ $d->barang->kondisi }}

                    </p>

                    <p class="text-secondary mb-0">

                        <strong>Lokasi:</strong>
                        {{ $d->barang->lokasi }}

                    </p>

                </div>

            </div>

        </div>

        @endforeach

    </div>
    <!-- INFORMASI PENGEMBALIAN -->
    @if($peminjaman->status == 'dikembalikan')

        <div class="detail-card mt-5">

            <h4 class="fw-bold mb-4">

                📄 Informasi Pengembalian

            </h4>

            <div class="row g-4">

                <!-- KONDISI -->
                <div class="col-md-4">

                    <div class="info-box">

                        <div class="info-title">

                            Kondisi Barang

                        </div>

                        <div class="info-value">

                            {{ $peminjaman->kondisi_kembali }}

                        </div>

                    </div>

                </div>

                <!-- DENDA -->
                <div class="col-md-4">

                    <div class="info-box">

                        <div class="info-title">

                            Denda

                        </div>

                        <div class="info-value">

                            Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}

                        </div>

                    </div>

                </div>

                <!-- CATATAN -->
                <div class="col-md-4">

                    <div class="info-box">

                        <div class="info-title">

                            Catatan Admin

                        </div>

                        <div class="info-value">

                            {{ $peminjaman->catatan_admin ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif
</div>

</body>
</html>