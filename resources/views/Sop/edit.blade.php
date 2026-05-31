<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit SOP Barang</title>

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

            padding: 35px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .form-label{

            font-weight: 600;

            color: #0B1F66;
        }

        .form-control,
        .form-select{

            border-radius: 14px;

            padding: 12px 15px;

            border: 1px solid #DCE4F5;
        }

        .form-control:focus,
        .form-select:focus{

            border-color: #1565FF;

            box-shadow: none;
        }

        textarea{

            min-height: 150px;

            resize: none;
        }

        .btn-main{

            background: #1565FF;

            color: white;

            border: none;

            border-radius: 14px;

            padding: 12px 25px;

            font-weight: 600;

            transition: 0.3s;
        }

        .btn-main:hover{

            background: #0B1F66;

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
    <div class="mb-4">

        <a href="{{ route('sop.index') }}"
           class="back-btn">

            <i class="bi bi-arrow-left"></i>
            Kembali ke Data SOP

        </a>

        <h1 class="page-title mt-3">

            ✏️ Edit SOP Barang

        </h1>

    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="{{ route('admin.sop.update', $sop->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <!-- PILIH BARANG -->
            <div class="mb-4">

                <label class="form-label">

                    Barang

                </label>

                <select name="barang_id"
                        class="form-select">

                    @foreach($barang as $b)

                        <option value="{{ $b->id }}"
                            {{ $sop->barang_id == $b->id ? 'selected' : '' }}>

                            {{ $b->nama_barang }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- JUDUL SOP -->
            <div class="mb-4">

                <label class="form-label">

                    Judul SOP

                </label>

                <input type="text"
                       name="judul_sop"
                       class="form-control"
                       value="{{ $judul }}"
                       required>

            </div>

            <!-- LANGKAH -->
            <div class="mb-4">

                <label class="form-label">

                    Langkah-Langkah

                </label>

                <textarea name="langkah"
                          class="form-control"
                          required>{{ $langkah }}</textarea>

            </div>

            <!-- CATATAN -->
            <div class="mb-4">

                <label class="form-label">

                    Catatan

                </label>

                <textarea name="catatan"
                          class="form-control">{{ $catatan }}</textarea>

            </div>

            <!-- PERINGATAN -->
            <div class="mb-4">

                <label class="form-label">

                    Peringatan

                </label>

                <textarea name="peringatan"
                          class="form-control">{{ $peringatan }}</textarea>

            </div>

            <button type="submit"
                    class="btn-main">

                <i class="bi bi-save"></i>
                Update SOP

            </button>

        </form>

    </div>

</div>

</body>
</html>