<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Barang</title>

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

        /* CARD */

        .table-card,
        .barang-card{

            background: white;

            border-radius: 28px;

            overflow: hidden;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .table-card{

            padding: 30px;
        }

        .barang-card{

            transition: 0.3s;

            height: 100%;
        }

        .barang-card:hover{

            transform: translateY(-6px);
        }

        .barang-image{

            width: 100%;

            height: 220px;

            object-fit: cover;
        }

        .barang-content{

            padding: 25px;
        }

        .barang-title{

            color: #0B1F66;

            font-weight: 700;
        }

        .stok-badge{

            background: rgba(21,101,255,0.1);

            color: #1565FF;

            padding: 8px 14px;

            border-radius: 12px;

            font-size: 14px;

            font-weight: 600;

            display: inline-block;
        }

        .info-text{

            color: #6c757d;

            margin-bottom: 8px;
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

        .table{

            vertical-align: middle;
        }

        .table th{

            color: #0B1F66;
        }

        .action-btn{

            width: 38px;

            height: 38px;

            border-radius: 10px;

            border: 1px solid #E5EAF5;

            background: white;

            color: #0B1F66;

            transition: 0.3s;
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

                📦 Data Barang Laboratorium

            </h1>

        </div>

        @if(auth()->user()->role == 'admin')

            <a href="{{ url('/admin/barang/create') }}"
               class="btn-main">

                + Tambah Barang

            </a>

        @endif

    </div>

    {{-- =========================
         ADMIN
    ========================== --}}
    @if(auth()->user()->role == 'admin')

        <div class="table-card">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Kondisi</th>
                            <th>Lokasi</th>
                            <th class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($barang as $key => $b)

                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td>

                                @if($b->gambar)

                                    <img src="{{ asset('storage/'.$b->gambar) }}"
                                         width="70"
                                         height="70"
                                         style="object-fit:cover; border-radius:14px;">

                                @else

                                    <span class="text-muted">

                                        Tidak ada

                                    </span>

                                @endif

                            </td>

                            <td>

                                <strong>

                                    {{ $b->nama_barang }}

                                </strong>

                            </td>

                            <td>{{ $b->kategori }}</td>

                            <td>{{ $b->stok }}</td>

                            <td>{{ $b->kondisi }}</td>

                            <td>{{ $b->lokasi }}</td>

                            <td class="text-center">

                                <a href="{{ url('/admin/barang/'.$b->id.'/edit') }}"
                                   class="btn action-btn">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form action="{{ url('/admin/barang/'.$b->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Hapus data?')"
                                            class="btn action-btn">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    {{-- =========================
         USER
    ========================== --}}
    @else

        <div class="row g-4">

            @foreach($barang as $b)

            <div class="col-lg-4">

                <div class="barang-card">

                    @if($b->gambar)

                        <img src="{{ asset('storage/'.$b->gambar) }}"
                             class="barang-image">

                    @endif

                    <div class="barang-content">

                        <h4 class="barang-title">

                            {{ $b->nama_barang }}

                        </h4>

                        <div class="stok-badge mb-3">

                            Stok: {{ $b->stok }}

                        </div>

                        <p class="info-text">

                            <strong>Kategori:</strong>
                            {{ $b->kategori }}

                        </p>

                        <p class="info-text">

                            <strong>Kondisi:</strong>
                            {{ $b->kondisi }}

                        </p>

                        <p class="info-text">

                            <strong>Lokasi:</strong>
                            {{ $b->lokasi }}

                        </p>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    @endif

</div>

</body>
</html>