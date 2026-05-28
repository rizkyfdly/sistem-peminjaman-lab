<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail SOP Barang</title>

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

            border-radius: 30px;

            padding: 35px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .barang-image{

            width: 100%;

            max-height: 320px;

            object-fit: cover;

            border-radius: 24px;
        }

        .section-title{

            color: #0B1F66;

            font-weight: 700;

            margin-bottom: 15px;
        }

        .sop-box{

            background: #F8FAFF;

            border-radius: 20px;

            padding: 20px;

            border: 1px solid #E6ECFA;

            margin-bottom: 20px;
        }

        .sop-content{

            white-space: pre-line;

            color: #495057;

            line-height: 1.9;
        }

        .back-btn{

            text-decoration: none;

            color: #0B1F66;

            font-weight: 600;
        }

        .info-badge{

            background: rgba(21,101,255,0.1);

            color: #1565FF;

            padding: 8px 15px;

            border-radius: 12px;

            font-size: 14px;

            font-weight: 600;

            display: inline-block;
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

    </div>

    <!-- CARD -->
    <div class="detail-card">

        <div class="row g-5 align-items-start">

            <!-- GAMBAR -->
            <div class="col-lg-4">

                @if($barang->gambar)

                    <img src="{{ asset('storage/'.$barang->gambar) }}"
                         class="barang-image">

                @else

                    <div class="text-secondary">

                        Tidak ada gambar

                    </div>

                @endif

            </div>

            <!-- DETAIL -->
            <div class="col-lg-8">

                <h2 class="fw-bold mb-3">

                    {{ $barang->nama_barang }}

                </h2>

                <div class="info-badge mb-4">

                    SOP Barang Laboratorium

                </div>

                <!-- DAFTAR SOP -->

                    <div class="sop-box">

                        <h5 class="section-title">

                            <i class="bi bi-file-earmark-text"></i>
                            Isi SOP

                        </h5>

                        <div class="sop-content">

                            {{ $sop->isi_sop }}

                        </div>

                    </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>