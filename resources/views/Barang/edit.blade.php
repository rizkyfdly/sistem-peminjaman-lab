<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Barang</title>

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

        .form-card{

            background: white;

            border-radius: 28px;

            padding: 40px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .page-title{

            color: #0B1F66;

            font-weight: 800;
        }

        .form-control,
        .form-select{

            height: 55px;

            border-radius: 14px;

            border: 1px solid #E5EAF5;
        }

        .form-control:focus,
        .form-select:focus{

            box-shadow: none;

            border-color: #1565FF;
        }

        .btn-main{

            background: #1565FF;

            color: white;

            border: none;

            border-radius: 14px;

            padding: 12px 25px;

            transition: 0.3s;
        }

        .btn-main:hover{

            background: #0B1F66;
        }

        .back-btn{

            text-decoration: none;

            color: #0B1F66;

            font-weight: 600;
        }

        .preview-image{

            width: 140px;

            height: 140px;

            object-fit: cover;

            border-radius: 20px;

            margin-bottom: 15px;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <a href="{{ url('/barang') }}"
       class="back-btn">

        <i class="bi bi-arrow-left"></i>
        Kembali ke Data Barang

    </a>

    <h1 class="page-title my-4">

        ✏️ Edit Barang

    </h1>

    <div class="form-card">

        <form action="{{ url('/admin/barang/'.$barang->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Nama Barang

                    </label>

                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           value="{{ $barang->nama_barang }}">

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Kode Barang

                    </label>

                    <input type="text"
                           name="kode_barang"
                           class="form-control"
                           value="{{ $barang->kode_barang }}">

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Kategori

                    </label>

                    <select name="kategori"
                            class="form-select">

                        <option value="alat"
                            {{ $barang->kategori == 'alat' ? 'selected' : '' }}>

                            Alat

                        </option>

                        <option value="bahan"
                            {{ $barang->kategori == 'bahan' ? 'selected' : '' }}>

                            Bahan

                        </option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Satuan

                    </label>

                    <select name="satuan"
                            class="form-select">

                        <option value="pcs"
                            {{ $barang->satuan == 'pcs' ? 'selected' : '' }}>

                            PCS

                        </option>

                        <option value="gram"
                            {{ $barang->satuan == 'gram' ? 'selected' : '' }}>

                            Gram

                        </option>

                        <option value="ml"
                            {{ $barang->satuan == 'ml' ? 'selected' : '' }}>

                            ML

                        </option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Stok

                    </label>

                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ $barang->stok }}">

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Kondisi

                    </label>

                    <input type="text"
                           name="kondisi"
                           class="form-control"
                           value="{{ $barang->kondisi }}">

                </div>

                <div class="col-md-12">

                    <label class="mb-2 fw-semibold">

                        Lokasi

                    </label>

                    <input type="text"
                           name="lokasi"
                           class="form-control"
                           value="{{ $barang->lokasi }}">

                </div>

                <div class="col-md-12">

                    <label class="mb-3 fw-semibold">

                        Gambar Barang

                        <small>(Ukuran gambar 7x9)

                    </label>

                    <br>

                    @if($barang->gambar)

                        <img src="{{ asset('storage/'.$barang->gambar) }}"
                             class="preview-image">

                    @endif

                    <input type="file"
                           name="gambar"
                           class="form-control">

                </div>

            </div>

            <button type="submit"
                    class="btn-main mt-4">

                Update Barang

            </button>

        </form>

    </div>

</div>

</body>
</html>