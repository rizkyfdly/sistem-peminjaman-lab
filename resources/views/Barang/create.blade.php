<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah Barang</title>

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

        + Tambah Barang

    </h1>

    <div class="form-card">

        <form action="{{ url('/admin/barang') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Nama Barang

                    </label>

                    <input type="text"
                           name="nama_barang"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Kode Barang

                    </label>

                    <input type="text"
                           name="kode_barang"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Kategori

                    </label>

                    <select name="kategori"
                            class="form-select">

                        <option value="alat">Alat</option>
                        <option value="bahan">Bahan</option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Satuan

                    </label>

                    <select name="satuan"
                            class="form-select">

                        <option value="pcs">PCS</option>
                        <option value="gram">Gram</option>
                        <option value="ml">ML</option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Stok

                    </label>

                    <input type="number"
                           name="stok"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="mb-2 fw-semibold">

                        Kondisi

                    </label>

                    <input type="text"
                           name="kondisi"
                           class="form-control">

                </div>

                <div class="col-md-12">

                    <label class="mb-2 fw-semibold">

                        Lokasi

                    </label>

                    <input type="text"
                           name="lokasi"
                           class="form-control">

                </div>

                <div class="col-md-12">

                    <label class="mb-2 fw-semibold">

                        Gambar Barang

                    </label>

                    <input type="file"
                           name="gambar"
                           class="form-control">

                </div>

            </div>

            <button type="submit"
                    class="btn-main mt-4">

                Simpan Barang

            </button>

        </form>

    </div>

</div>

</body>
</html>