<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah Peminjaman</title>

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

        .barang-box{

            background: #F8FAFF;

            border-radius: 20px;

            padding: 20px;
        }

        .user-box{

            background: rgba(21,101,255,0.08);

            border-radius: 18px;

            padding: 18px;

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

            ➕ Tambah Peminjaman

        </h1>

    </div>

    <!-- ERROR -->
    @if(session('error'))

        <div class="alert alert-danger rounded-4">

            {{ session('error') }}

        </div>

    @endif

    @if($errors->any())

    <div class="alert alert-danger rounded-4">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

    <!-- FORM -->
    <div class="form-card">

        <form action="/peminjaman"
              method="POST">

            @csrf

            <!-- USER -->
            <div class="user-box mb-4">

                <i class="bi bi-person-circle"></i>

                User:
                {{ auth()->user()->name }}

            </div>

            <input type="hidden"
                   name="user_id"
                   value="{{ auth()->id() }}">
            
            <div class="col-md-12">

                <label class="form-label fw-semibold">

                    Jenis Praktikum

                </label>

                <select name="jenis_praktikum"
                        class="form-select"
                        required>

                    <option value="">
                        Pilih Praktikum
                    </option>

                    <option>BOTANI FARMASI</option>
                    <option>KIMIA FARMASI DASAR</option>
                    <option>ANATOMI DAN FISIOLOGI MANUSIA</option>
                    <option>FARMAKOLOGI I</option>
                    <option>FARMASETIKA</option>
                    <option>FARMASI FISIKA</option>
                    <option>BIOKIMIA</option>
                    <option>FARMAKOLOGI II</option>
                    <option>MIKROBIOLOGI</option>
                    <option>FARMAKOGNOSI</option>
                    <option>KIMIA ORGANIK</option>
                    <option>KIMIA ANALISIS</option>
                    <option>ANALISIS FARMASI</option>
                    <option>FTS PADAT</option>
                    <option>FARMAKOKINETIKA</option>
                    <option>FITOKIMIA</option>
                    <option>STANDARISASI BAHAN OBAT ALAM (SBOA)</option>
                    <option>FTS STERIL</option>
                    <option>COMDIS (COMPOUNDING & DISPENDING)</option>
                    <option>FTS SEMI PADAT DAN CAIR</option>
                    <option>PENELITIAN</option>

                </select>

            </div>

            <!-- BARANG -->
            <!-- BARANG -->
            <div class="barang-box">

                <h5 class="fw-bold mb-4">
                    📦 Pilih Barang
                </h5>

                <div id="barang-container">

                    <div class="row g-4 barang-item mb-3">

                        <div class="col-md-7">

                            <label class="mb-2 fw-semibold">
                                Barang
                            </label>

                            <select name="barang[0][id]"
                                    class="form-select">

                                @foreach($barang as $b)

                                    <option value="{{ $b->id }}">

                                        {{ $b->nama_barang }}
                                        (stok: {{ $b->stok }})

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label class="mb-2 fw-semibold">
                                Jumlah
                            </label>

                            <input type="number"
                                name="barang[0][jumlah]"
                                class="form-control"
                                min="1"
                                required>

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            <button type="button"
                                    class="btn btn-danger remove-barang">

                                Hapus

                            </button>

                        </div>

                    </div>

                </div>

                <button type="button"
                        id="tambahBarang"
                        class="btn btn-outline-primary mt-3">

                    + Tambah Barang

                </button>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="btn-main mt-4">

                Simpan Peminjaman

            </button>

        </form>

    </div>

</div>

<script>

let index = 1;

document.getElementById('tambahBarang')
.addEventListener('click', function () {

    let html = `
        <div class="row g-4 barang-item mb-3">

            <div class="col-md-7">

                <select name="barang[${index}][id]"
                        class="form-select">

                    @foreach($barang as $b)

                        <option value="{{ $b->id }}">

                            {{ $b->nama_barang }}
                            (stok: {{ $b->stok }})

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <input type="number"
                       name="barang[${index}][jumlah]"
                       class="form-control"
                       min="1"
                       required>

            </div>

            <div class="col-md-2">

                <button type="button"
                        class="btn btn-danger remove-barang">

                    Hapus

                </button>

            </div>

        </div>
    `;

    document
        .getElementById('barang-container')
        .insertAdjacentHTML('beforeend', html);

    index++;
});

document.addEventListener('click', function(e){

    if(e.target.classList.contains('remove-barang')){

        e.target
         .closest('.barang-item')
         .remove();
    }
});

</script>

</body>
</html>