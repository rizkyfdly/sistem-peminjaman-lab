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

            background: #F5F9FF;

            overflow-x: hidden;
        }

        /* SIDEBAR */

        .sidebar{

            width: 280px;

            height: 100vh;

            background: white;

            position: fixed;

            top: 0;

            left: 0;

            padding: 30px 22px;

            border-right: 1px solid #E8EEFF;

            z-index: 1050;

            transition: 0.3s;
        }

        .sidebar-logo{

            text-align: center;

            margin-bottom: 45px;
        }

        .sidebar-logo img{

            height: 60px;
        }

        .menu-title{

            color: #9AA5C3;

            font-size: 13px;

            text-transform: uppercase;

            margin-bottom: 15px;

            padding-left: 10px;

            font-weight: 600;

            letter-spacing: 1px;
        }

        .menu-link{

            display: flex;

            align-items: center;

            gap: 14px;

            text-decoration: none;

            color: #0B1F66;

            padding: 15px 18px;

            border-radius: 18px;

            margin-bottom: 12px;

            transition: 0.3s;

            font-weight: 600;
        }

        .menu-link i{

            font-size: 20px;
        }

        .menu-link:hover{

            background: rgba(21,101,255,0.08);

            color: #1565FF;

            transform: translateX(5px);
        }

        .menu-link.active{

            background:
                linear-gradient(
                    135deg,
                    #0B1F66,
                    #1565FF
                );

            color: white;

            box-shadow: 0 10px 20px rgba(21,101,255,0.2);
        }

        /* MOBILE SIDEBAR */

        .sidebar-overlay{

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;

            background: rgba(0,0,0,0.4);

            z-index: 1040;

            display: none;
        }

        .sidebar-overlay.show{

            display: block;
        }

        /* MAIN */

        .main-content{

            margin-left: 280px;

            padding: 35px;
        }

        /* TOPBAR */

        .topbar{

            background: white;

            border-radius: 28px;

            padding: 22px 28px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .topbar-left{

            display: flex;

            align-items: center;

            gap: 18px;
        }

        .toggle-btn{

            width: 48px;

            height: 48px;

            border-radius: 14px;

            border: none;

            background: #F5F9FF;

            color: #1565FF;

            display: none;
        }

        .toggle-btn i{

            font-size: 24px;
        }

        .topbar h3{

            margin: 0;

            color: #0B1F66;

            font-weight: 800;
        }

        .topbar p{

            margin: 0;

            color: #7B88A8;
        }

        /* PROFILE */

        .profile-btn{

            background: transparent;

            border: none;
        }

        .profile-btn img{

            width: 48px;

            height: 48px;

            border-radius: 50%;

            object-fit: cover;
        }

        .dropdown-menu{

            border: none;

            border-radius: 22px;

            padding: 10px;

            min-width: 220px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .dropdown-item{

            border-radius: 14px;

            padding: 12px 14px;

            font-weight: 500;
        }

        .dropdown-item:hover{

            background: #F5F9FF;
        }

        /* HERO */

        .hero-card{

            background:
                linear-gradient(
                    135deg,
                    #0B1F66,
                    #1565FF
                );

            border-radius: 35px;

            padding: 50px;

            color: white;

            position: relative;

            overflow: hidden;

            margin-bottom: 30px;
        }

        .hero-card::before{

            content: '';

            position: absolute;

            width: 300px;

            height: 300px;

            border-radius: 50%;

            background: rgba(255,255,255,0.08);

            top: -120px;

            right: -100px;
        }

        .hero-card h1{

            font-size: 44px;

            font-weight: 800;

            position: relative;

            z-index: 2;
        }

        .hero-card p{

            margin-top: 20px;

            max-width: 650px;

            line-height: 1.9;

            position: relative;

            z-index: 2;
        }

        .hero-btn{

            background: white;

            color: #1565FF;

            text-decoration: none;

            padding: 13px 25px;

            border-radius: 14px;

            display: inline-block;

            margin-top: 20px;

            font-weight: 600;

            position: relative;

            z-index: 2;

            transition: 0.3s;
        }

        .hero-btn:hover{

            transform: translateY(-4px);

            color: #1565FF;
        }

        /* STATS */

        .stats-card{

            background: white;

            border-radius: 28px;

            padding: 28px;

            height: 100%;

            box-shadow: 0 5px 20px rgba(0,0,0,0.04);

            transition: 0.3s;
        }

        .stats-card:hover{

            transform: translateY(-8px);
        }

        .stats-icon{

            width: 75px;

            height: 75px;

            border-radius: 22px;

            background: rgba(21,101,255,0.1);

            display: flex;

            justify-content: center;

            align-items: center;

            margin-bottom: 22px;
        }

        .stats-icon i{

            color: #1565FF;

            font-size: 34px;
        }

        .stats-card h2{

            color: #0B1F66;

            font-weight: 800;

            font-size: 40px;
        }

        .stats-card p{

            margin: 0;

            color: #7B88A8;

            font-weight: 500;
        }

        /* ACTIVITY */

        .activity-card{

            background: white;

            border-radius: 30px;

            padding: 35px;

            margin-top: 35px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .activity-title{

            color: #0B1F66;

            font-weight: 700;

            margin-bottom: 25px;
        }

        .activity-item{

            display: flex;

            align-items: center;

            gap: 18px;

            padding: 18px 0;

            border-bottom: 1px solid #EEF2FF;
        }

        .activity-item:last-child{

            border-bottom: none;
        }

        .activity-icon{

            width: 55px;

            height: 55px;

            border-radius: 16px;

            background: rgba(21,101,255,0.1);

            color: #1565FF;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 24px;
        }

        .activity-item h6{

            margin: 0;

            color: #0B1F66;

            font-weight: 700;
        }

        .activity-item p{

            margin: 0;

            color: #7B88A8;

            font-size: 14px;
        }

        /* MOBILE */

        @media(max-width: 991px){

            .sidebar{

                left: -100%;
            }

            .sidebar.show{

                left: 0;
            }

            .main-content{

                margin-left: 0;

                padding: 20px;
            }

            .toggle-btn{

                display: flex;

                justify-content: center;

                align-items: center;
            }

            .topbar{

                padding: 20px;
            }

            .hero-card{

                padding: 35px 28px;
            }

            .hero-card h1{

                font-size: 32px;
            }

            .topbar h3{

                font-size: 22px;
            }

            .profile-name{

                display: none;
            }
        }

    </style>

</head>

<body>

<!-- OVERLAY -->
<div class="sidebar-overlay"
     id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar"
     id="sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">

        <img src="{{ asset('logo-labs-farm.png') }}">

    </div>

    <!-- MENU -->
    <div class="menu-title">

        Main Menu

    </div>

    <a href="/dashboard"
       class="menu-link active">

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

<!-- MAIN -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar">

        <!-- LEFT -->
        <div class="topbar-left">

            <!-- TOGGLE -->
            <button class="toggle-btn"
                    id="toggleSidebar">

                <i class="bi bi-list"></i>

            </button>

            <div>

                <h3>

                    Halo,
                    {{ auth()->user()->name }} 👋

                </h3>

                <p>

                    Dashboard Administrator Briegen Labs

                </p>

            </div>

        </div>

        <!-- PROFILE -->
        <div class="dropdown">

            <button class="profile-btn d-flex align-items-center gap-3"
                    data-bs-toggle="dropdown">

                @if(auth()->user()->foto)

                    <img src="{{ asset('storage/'.auth()->user()->foto) }}">

                @else

                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}">

                @endif

                <div class="profile-name text-start">

                    <div class="fw-bold text-dark">

                        {{ auth()->user()->name }}

                    </div>

                    <small class="text-secondary">

                        Administrator

                    </small>

                </div>

                <i class="bi bi-chevron-down"></i>

            </button>

            <!-- DROPDOWN -->
            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <a href="{{ route('profile') }}"
                       class="dropdown-item">

                        <i class="bi bi-person-circle me-2"></i>
                        Lihat Profil

                    </a>

                </li>

                <li><hr class="dropdown-divider"></li>

                <li>

                    <form action="/logout"
                          method="POST">

                        @csrf

                        <button type="submit"
                                class="dropdown-item text-danger">

                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

    <!-- HERO -->
    <div class="hero-card">

        <h1>

            Dashboard Admin Briegen Labs

        </h1>

        <p>

            Kelola seluruh aktivitas laboratorium farmasi
            mulai dari data barang,
            SOP penggunaan alat,
            hingga peminjaman laboratorium
            dalam satu sistem modern dan terstruktur.

        </p>

        <a href="/admin/barang/create"
           class="hero-btn">

            + Tambah Barang

        </a>

    </div>

    <!-- STATS -->
    <div class="row g-4">

        <!-- CARD -->
        <div class="col-lg-3 col-md-6">

            <div class="stats-card">

                <div class="stats-icon">

                    <i class="bi bi-box-seam"></i>

                </div>

                <h2>

                    {{ \App\Models\Barang::count() }}

                </h2>

                <p>

                    Total Barang

                </p>

            </div>

        </div>

        <!-- CARD -->
        <div class="col-lg-3 col-md-6">

            <div class="stats-card">

                <div class="stats-icon">

                    <i class="bi bi-people-fill"></i>

                </div>

                <h2>

                    {{ \App\Models\User::count() }}

                </h2>

                <p>

                    Total User

                </p>

            </div>

        </div>

        <!-- CARD -->
        <div class="col-lg-3 col-md-6">

            <div class="stats-card">

                <div class="stats-icon">

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

        <!-- CARD -->
        <div class="col-lg-3 col-md-6">

            <div class="stats-card">

                <div class="stats-icon">

                    <i class="bi bi-file-earmark-text"></i>

                </div>

                <h2>

                    {{ \App\Models\SopBarang::count() }}

                </h2>

                <p>

                    Total SOP

                </p>

            </div>

        </div>

    </div>

    <!-- ACTIVITY -->
    <div class="activity-card">

        <h4 class="activity-title">

            Aktivitas Sistem

        </h4>

        <!-- ITEM -->
        <div class="activity-item">

            <div class="activity-icon">

                <i class="bi bi-box"></i>

            </div>

            <div>

                <h6>

                    Kelola Data Barang

                </h6>

                <p>

                    Tambahkan dan atur seluruh barang laboratorium.

                </p>

            </div>

        </div>

        <!-- ITEM -->
        <div class="activity-item">

            <div class="activity-icon">

                <i class="bi bi-journal-text"></i>

            </div>

            <div>

                <h6>

                    Monitoring Peminjaman

                </h6>

                <p>

                    Pantau aktivitas peminjaman user laboratorium.

                </p>

            </div>

        </div>

        <!-- ITEM -->
        <div class="activity-item">

            <div class="activity-icon">

                <i class="bi bi-file-earmark-text"></i>

            </div>

            <div>

                <h6>

                    SOP Barang Laboratorium

                </h6>

                <p>

                    Kelola SOP penggunaan alat laboratorium.

                </p>

            </div>

        </div>

    </div>

</div>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<!-- SIDEBAR TOGGLE -->
<script>

    const toggleSidebar = document.getElementById('toggleSidebar');

    const sidebar = document.getElementById('sidebar');

    const overlay = document.getElementById('sidebarOverlay');

    toggleSidebar.addEventListener('click', () => {

        sidebar.classList.toggle('show');

        overlay.classList.toggle('show');

    });

    overlay.addEventListener('click', () => {

        sidebar.classList.remove('show');

        overlay.classList.remove('show');

    });

</script>

</body>
</html>