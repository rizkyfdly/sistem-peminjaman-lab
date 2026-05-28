<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

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

            background:
                linear-gradient(
                    180deg,
                    #0B1F66,
                    #1565FF
                );
        }

        /* SIDEBAR */

        .sidebar{

            width: 270px;

            height: 100vh;

            background: white;

            position: fixed;

            left: 0;

            top: 0;

            padding: 30px 20px;

            border-right: 1px solid #E5EAF5;
        }

        .sidebar img{

            height: 60px;

            margin-bottom: 40px;
        }

        .menu-link{

            display: block;

            color: #0B1F66;

            text-decoration: none;

            padding: 14px 18px;

            border-radius: 14px;

            margin-bottom: 10px;

            transition: 0.3s;

            font-weight: 500;
        }

        .menu-link:hover{

            background: rgba(21,101,255,0.1);

            color: #1565FF;
        }

        /* CONTENT */

        .main-content{

            margin-left: 270px;

            padding: 40px;
        }

        /* TOPBAR */

        .topbar{

            background: white;

            padding: 20px 30px;

            border-radius: 24px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);

            margin-bottom: 35px;
        }

        .topbar h3{

            color: #0B1F66;

            font-weight: 700;

            margin: 0;
        }

        .topbar p{

            margin: 0;

            color: #6c757d;
        }

        /* CARD */

        .dashboard-card{

            background: white;

            border-radius: 28px;

            padding: 30px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);

            height: 100%;

            transition: 0.3s;
        }

        .dashboard-card:hover{

            transform: translateY(-6px);
        }

        .card-icon{

            width: 75px;

            height: 75px;

            border-radius: 20px;

            display: flex;

            justify-content: center;

            align-items: center;

            margin-bottom: 20px;
        }

        .card-icon i{

            font-size: 34px;

            color: white;
        }

        .bg-blue{

            background: #1565FF;
        }

        .bg-green{

            background: #198754;
        }

        .bg-orange{

            background: #fd7e14;
        }

        .dashboard-card h2{

            font-weight: 800;

            color: #0B1F66;
        }

        .dashboard-card p{

            color: #6c757d;

            margin: 0;
        }

        /* QUICK ACTION */

        .quick-card{

            background:
                linear-gradient(
                    135deg,
                    #0B1F66,
                    #1565FF
                );

            border-radius: 30px;

            padding: 40px;

            color: white;

            margin-top: 40px;
        }

        .quick-btn{

            background: white;

            color: #1565FF;

            text-decoration: none;

            padding: 12px 24px;

            border-radius: 14px;

            display: inline-block;

            font-weight: 600;

            margin-top: 15px;
        }

        .logout-btn{

            background: #dc3545;

            border: none;

            color: white;

            padding: 10px 20px;

            border-radius: 12px;
        }

        /* MOBILE */

        @media(max-width: 991px){

            .sidebar{

                width: 100%;

                height: auto;

                position: relative;
            }

            .main-content{

                margin-left: 0;
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

    <img src="{{ asset('logo-navbar.png') }}">

    <a href="/dashboard"
       class="menu-link">

        <i class="bi bi-grid-fill"></i>
        Dashboard

    </a>

    <a href="/barang"
       class="menu-link">

        <i class="bi bi-box-seam"></i>
        Barang

    </a>

    <a href="/peminjaman"
       class="menu-link">

        <i class="bi bi-journal-text"></i>
        Peminjaman

    </a>

    <a href="/sop"
       class="menu-link">

        <i class="bi bi-file-earmark-text"></i>
        SOP Barang

    </a>

    <a href="{{ route('admin.users.index') }}"
       class="menu-link">

        <i class="bi bi-people-fill"></i>
        Manajemen User

    </a>

</div>

<!-- CONTENT -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>

            <h3>

                Selamat Datang,
                {{ auth()->user()->name }}

            </h3>

            <p>

                Admin FarmLab Access

            </p>

        </div>

        <form action="/logout"
              method="POST">

            @csrf

            <button type="submit"
                    class="logout-btn">

                Logout

            </button>

        </form>

    </div>

    <!-- CARD -->
    <div class="row g-4">

        <!-- BARANG -->
        <div class="col-lg-4">

            <div class="dashboard-card">

                <div class="card-icon bg-blue">

                    <i class="bi bi-box-seam"></i>

                </div>

                <h2>

                    {{ \App\Models\Barang::count() }}

                </h2>

                <p>

                    Total Barang Laboratorium

                </p>

            </div>

        </div>

        <!-- USER -->
        <div class="col-lg-4">

            <div class="dashboard-card">

                <div class="card-icon bg-green">

                    <i class="bi bi-people-fill"></i>

                </div>

                <h2>

                    {{ \App\Models\User::count() }}

                </h2>

                <p>

                    Total User Sistem

                </p>

            </div>

        </div>

        <!-- PEMINJAMAN -->
        <div class="col-lg-4">

            <div class="dashboard-card">

                <div class="card-icon bg-orange">

                    <i class="bi bi-journal-check"></i>

                </div>

                <h2>

                    {{ \App\Models\Peminjaman::count() }}

                </h2>

                <p>

                    Total Peminjaman

                </p>

            </div>

        </div>

    </div>

    <!-- QUICK ACTION -->
    <div class="quick-card">

        <h2 class="fw-bold">

            Kelola Sistem Laboratorium

        </h2>

        <p class="mt-3">

            Tambahkan data barang,
            kelola user, dan pantau
            aktivitas peminjaman laboratorium.

        </p>

        <a href="/admin/barang/create"
           class="quick-btn">

            + Tambah Barang

        </a>

    </div>

</div>

</body>
</html>