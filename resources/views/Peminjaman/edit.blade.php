<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Peminjaman</title>

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

        .form-card{

            background: white;

            border-radius: 28px;

            padding: 40px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
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

            padding: 12px 24px;

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

        .info-card{

            background: #F8FAFF;

            border-radius: 20px;

            padding: 20px;
        }

        .barang-item{

            background: white;

            border-radius: 14px;

            padding: 14px 18px;

            margin-bottom: 12px;

            border: 1px solid #EEF2FA;
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

            ✏️ Edit Peminjaman

        </h1>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

        <div class="alert alert-success rounded-4">

            {{ session('success') }}

        </div>

    @endif

    <!-- FORM -->
    <div class="form-card">

        <form action="/peminjaman/{{ $peminjaman->id }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- USER -->
                <div class="col-md-12">

                    <div class="info-card">

                        <strong>

                            <i class="bi bi-person-circle"></i>
                            User:

                        </strong>

                        {{ auth()->user()->name }}

                    </div>

                </div>

                <!-- DETAIL BARANG -->
                <div class="col-md-12">

                    <div class="info-card">

                        <h5 class="fw-bold mb-4">

                            📦 Detail Barang

                        </h5>

                        @foreach($peminjaman->detail as $key => $d)

                            <div class="barang-item">

                                <div class="row align-items-center g-3">

                                    <div class="col-md-8">

                                        <label class="mb-2 fw-semibold">

                                            Barang

                                        </label>

                                        <select name="barang[{{ $key }}][id]"
                                                class="form-select">

                                            @foreach($barang as $b)

                                                <option value="{{ $b->id }}"
                                                    {{ $d->barang_id == $b->id ? 'selected' : '' }}>

                                                    {{ $b->nama_barang }}
                                                    (stok: {{ $b->stok }})

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-4">

                                        <label class="mb-2 fw-semibold">

                                            Jumlah

                                        </label>

                                        <input type="number"
                                            name="barang[{{ $key }}][jumlah]"
                                            value="{{ $d->jumlah }}"
                                            class="form-control">

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="btn-main mt-4">

                Update Peminjaman

            </button>

        </form>

    </div>

</div>

</body>
</html>