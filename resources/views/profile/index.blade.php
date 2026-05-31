<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Profil Saya</title>

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

        .profile-card{

            background: white;

            border-radius: 30px;

            padding: 40px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .profile-image{

            width: 150px;

            height: 150px;

            border-radius: 50%;

            object-fit: cover;

            border: 5px solid #EAF1FF;
        }

        .profile-name{

            color: #0B1F66;

            font-weight: 800;
        }

        .profile-role{

            display: inline-block;

            background: rgba(21,101,255,0.1);

            color: #1565FF;

            padding: 8px 18px;

            border-radius: 30px;

            font-weight: 600;

            font-size: 14px;
        }

        .info-card{

            background: #F8FAFF;

            border-radius: 20px;

            padding: 20px;

            border: 1px solid #E8EEFF;

            margin-bottom: 18px;
        }

        .info-label{

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 5px;
        }

        .info-value{

            color: #0B1F66;

            font-weight: 600;

            font-size: 16px;
        }

        .btn-edit{

            background: #1565FF;

            color: white;

            border-radius: 14px;

            padding: 12px 24px;

            text-decoration: none;

            font-weight: 600;

            transition: 0.3s;
        }

        .btn-edit:hover{

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

    <!-- BACK -->
    <!-- BACK -->
    <div class="mb-4">

        @if(auth()->user()->role == 'admin')

            <a href="{{ route('dashboard') }}"
            class="back-btn">

                <i class="bi bi-arrow-left"></i>
                Kembali ke Dashboard

            </a>

        @else

            <a href="{{ route('home') }}"
            class="back-btn">

                <i class="bi bi-arrow-left"></i>
                Kembali ke Home

            </a>

        @endif

    </div>

    <!-- PROFILE CARD -->
    <div class="profile-card">

        <div class="row align-items-center g-5">

            <!-- FOTO -->
            <div class="col-lg-4 text-center">

                @if(auth()->user()->foto)

                    <img src="{{ asset('storage/'.auth()->user()->foto) }}"
                         class="profile-image">

                @else

                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1565FF&color=fff"
                         class="profile-image">

                @endif

            </div>

            <!-- DATA -->
            <div class="col-lg-8">

                <h1 class="profile-name">

                    {{ auth()->user()->name }}

                </h1>

                <div class="profile-role mt-2 mb-4">

                    {{ auth()->user()->role }}

                </div>

                <!-- EMAIL -->
                <div class="info-card">

                    <div class="info-label">

                        Email

                    </div>

                    <div class="info-value">

                        {{ auth()->user()->email }}

                    </div>

                </div>

                <!-- ROLE -->
                <div class="info-card">

                    <div class="info-label">

                        NIM

                    </div>

                    <div class="info-value">

                        {{ auth()->user()->role }}

                    </div>

                </div>

                <!-- BERGABUNG -->
                <div class="info-card">

                    <div class="info-label">

                        Bergabung Sejak

                    </div>

                    <div class="info-value">

                        {{ auth()->user()->created_at->format('d F Y') }}

                    </div>

                </div>

                <!-- BUTTON EDIT -->
                <div class="mt-4">

                    <a href="{{ route('profile.edit') }}"
                       class="btn-edit">

                        <i class="bi bi-pencil-square"></i>
                        Edit Profil

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>