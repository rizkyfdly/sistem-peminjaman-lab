<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Daftar SOP Barang</title>

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

        .barang-image{

            width: 70px;

            height: 70px;

            object-fit: cover;

            border-radius: 18px;
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
        }

        .action-btn:hover{

            background: #1565FF;

            color: white;
        }

        .back-btn{

            display: inline-flex;

            align-items: center;

            gap: 8px;

            text-decoration: none;

            color: #0B1F66;

            font-weight: 600;

            padding: 10px 18px;

            border-radius: 12px;

            transition: 0.3s;
        }

        .back-btn:hover{
            
            background: rgb(21, 103, 255);

            color: #fdfefe;
        }

        .detail-link{

            text-decoration: none;

            color: #1565FF;

            font-weight: 600;
        }

        .detail-link:hover{

            color: #0B1F66;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">



            <h1 class="page-title mt-3">

                📜 SOP Barang Laboratorium

            </h1>


        <!-- ADMIN ONLY -->
        @if(auth()->check() && auth()->user()->role == 'admin')

            <a href="{{ route('admin.sop.create') }}"
               class="btn-main">

                <i class="bi bi-plus-circle"></i>
                Tambah SOP

            </a>

        @endif

    </div>

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>

                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Isi SOP</th>

                        @if(auth()->check() && auth()->user()->role == 'admin')

                            <th class="text-center">

                                Aksi

                            </th>

                        @endif

                    </tr>

                </thead>

                <tbody>

                    @foreach($sop as $key => $item)

                    <tr>

                        <td>

                            {{ $key + 1 }}

                        </td>

                        <!-- GAMBAR -->
                        <td>

                            @if($item->barang && $item->barang->gambar)

                                <img src="{{ asset('storage/'.$item->barang->gambar) }}"
                                     class="barang-image">

                            @else

                                <div class="text-secondary">

                                    Tidak ada gambar

                                </div>

                            @endif

                        </td>

                        <!-- NAMA BARANG -->
                        <td>

                            <strong>

                                {{ $item->barang ? $item->barang->nama_barang : 'Barang tidak ditemukan' }}

                            </strong>

                        </td>

                        <!-- SOP -->
                        <!-- SOP -->
                        <td>

                            <a href="{{ route('sop.show', $item->id) }}"
                            class="detail-link">

                                <i class="bi bi-file-earmark-text"></i>
                                Lihat Detail SOP

                            </a>

                        </td>

                        <!-- AKSI -->
                        @if(auth()->check() && auth()->user()->role == 'admin')

                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.sop.edit', $item->id) }}"
                                   class="btn action-btn">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <!-- HAPUS -->
                                <form action="{{ route('admin.sop.destroy', $item->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Yakin hapus SOP?')"
                                            class="btn action-btn">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                        @endif

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

        <div class="mt-5">
        <a href="{{ auth()->user()->role == 'admin'
            ? route('dashboard')
            : route('home') }}"
        class="back-btn">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>
    </div>

</div>

</body>
</html>