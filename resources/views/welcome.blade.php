<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard - FarmLab Access</title>

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

            overflow-x: hidden;
        }

        /* SIDEBAR */

        .sidebar{

            width: 280px;

            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #0B1F66,
                    #1565FF
                );

            position: fixed;

            padding: 30px 20px;
        }

        .sidebar-logo{

            width: 170px;
        }

        .sidebar-menu{

            margin-top: 50px;
        }

        .sidebar-menu a{

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 15px 18px;

            color: white;

            text-decoration: none;

            border-radius: 14px;

            margin-bottom: 12px;

            transition: 0.3s;
        }

        .sidebar-menu a:hover{

            background: rgba(255,255,255,0.15);
        }

        .sidebar-menu i{

            font-size: 20px;
        }

        /* MAIN */

        .main-content{

            margin-left: 280px;

            padding: 40px;
        }

        /* TOPBAR */

        .topbar{

            background: white;

            padding: 20px 25px;

            border-radius: 20px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .welcome-text h3{

            color: #0B1F66;

            font-weight: 700;

            margin-bottom: 5px;
        }

        .welcome-text p{

            margin: 0;

            color: #6c757d;
        }

        .role-badge{

            background: #1565FF;

            color: white;

            padding: 10px 18px;

            border-radius: 12px;

            font-size: 14px;

            font-weight: 600;
        }

        /* CARD */

        .dashboard-card{

            background: white;

            border-radius: 24px;

            padding: 30px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);

            transition: 0.3s;
        }

        .dashboard-card:hover{

            transform: translateY(-5px);
        }

        .dashboard-icon{

            width: 70px;

            height: 70px;

            border-radius: 18px;

            background: rgba(21,101,255,0.1);

            display: flex;

            justify-content: center;

            align-items: center;

            margin-bottom: 20px;
        }

        .dashboard-icon i{

            font-size: 32px;

            color: #1565FF;
        }

        .dashboard-card h4{

            color: #0B1F66;

            font-weight: 700;
        }

        .dashboard-card p{

            color: #6c757d;

            margin-bottom: 0;
        }

        /* LOGOUT */

        .logout-btn{

            width: 100%;

            background: rgba(255,255,255,0.15);

            border: none;

            color: white;

            padding: 14px;

            border-radius: 14px;

            margin-top: 50px;

            transition: 0.3s;
        }

        .logout-btn:hover{

            background: rgba(255,255,255,0.25);
        }

        /* MOBILE */

        @media(max-width: 991px){

            .sidebar{

                position: relative;

                width: 100%;

                min-height: auto;
            }

            .main-content{

                margin-left: 0;

                padding: 25px;
            }

            .topbar{

                flex-direction: column;

                gap: 15px;

                text-align: center;
            }
        }

    </style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <!-- LOGO -->
    <div class="text-center">

        <img src="{{ asset('logo.png') }}"
             class="sidebar-logo img-fluid">

    </div>

    <!-- MENU -->
    <div class="sidebar-menu">

        <a href="{{ url('/') }}">

            <i class="bi bi-grid-fill"></i>

            Dashboard

        </a>

        <a href="{{ url('/barang') }}">

            <i class="bi bi-box-seam-fill"></i>

            Barang

        </a>

        <a href="{{ url('/peminjaman') }}">

            <i class="bi bi-journal-text"></i>

            Peminjaman

        </a>

        <a href="{{ url('/sop') }}">

            <i class="bi bi-file-earmark-text-fill"></i>

            SOP Barang

        </a>

        @if(auth()->user()->role == 'admin')

            <a href="{{ route('admin.users.index') }}">

                <i class="bi bi-people-fill"></i>

                Manajemen User

            </a>

        @endif

    </div>

    <!-- LOGOUT -->
    <form action="/logout"
          method="POST">

        @csrf

        <button type="submit"
                class="logout-btn">

            <i class="bi bi-box-arrow-left me-2"></i>

            Logout

        </button>

    </form>

</div>

<!-- MAIN -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar mb-4">

        <div class="welcome-text">

            <h3>

                Selamat Datang,
                {{ auth()->user()->name }}

            </h3>

            <p>

                Sistem Informasi Laboratorium Farmasi

            </p>

        </div>

        <div class="role-badge">

            {{ auth()->user()->role }}

        </div>

    </div>

    <!-- CARD -->
    <div class="row g-4">

        <!-- CARD 1 -->
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="dashboard-icon">

                    <i class="bi bi-box-seam"></i>

                </div>

                <h4>Data Barang</h4>

                <p>

                    Kelola seluruh data
                    barang laboratorium.

                </p>

            </div>

        </div>

        <!-- CARD 2 -->
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="dashboard-icon">

                    <i class="bi bi-journal-check"></i>

                </div>

                <h4>Peminjaman</h4>

                <p>

                    Kelola peminjaman
                    dan pengembalian barang.

                </p>

            </div>

        </div>

        <!-- CARD 3 -->
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="dashboard-icon">

                    <i class="bi bi-file-earmark-text"></i>

                </div>

                <h4>SOP Barang</h4>

                <p>

                    Informasi SOP penggunaan
                    alat laboratorium.

                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>