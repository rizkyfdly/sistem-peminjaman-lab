<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>User Home - FarmLab Access</title>

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

            padding-top: 100px;
        }

        /* TOPBAR */

        .topbar{

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            z-index: 999;

            background: rgba(255,255,255,0.95);

            backdrop-filter: blur(10px);

            padding: 18px 40px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            border-bottom: 1px solid #E8EEF9;
        }

        .logo{

            height: 55px;
        }

        /* PROFILE */

        .profile-btn{

            border: none;

            background: transparent;

            display: flex;

            align-items: center;

            gap: 12px;
        }

        .profile-image{

            width: 45px;

            height: 45px;

            object-fit: cover;

            border-radius: 50%;

            border: 2px solid #EAF1FF;
        }

        .profile-name{

            color: #0B1F66;

            font-weight: 600;

            margin: 0;
        }

        .dropdown-menu{

            border: none;

            border-radius: 20px;

            padding: 10px;

            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .dropdown-item{

            border-radius: 12px;

            padding: 12px 14px;

            font-weight: 500;
        }

        .dropdown-item:hover{

            background: #F4F8FF;
        }

        /* HERO */

        .hero{

            padding: 40px 0 70px;
        }

        .hero-box{

            background:
                linear-gradient(
                    135deg,
                    #0B1F66,
                    #1565FF
                );

            border-radius: 35px;

            padding: 65px;

            color: white;

            position: relative;

            overflow: hidden;
        }

        .hero-box::before{

            content: '';

            position: absolute;

            width: 320px;

            height: 320px;

            background: rgba(255,255,255,0.08);

            border-radius: 50%;

            top: -120px;

            right: -100px;
        }

        .hero-title{

            font-size: 48px;

            font-weight: 800;

            line-height: 1.3;

            position: relative;

            z-index: 2;
        }

        .hero-text{

            margin-top: 20px;

            max-width: 650px;

            line-height: 1.9;

            color: rgba(255,255,255,0.9);

            position: relative;

            z-index: 2;
        }

        .hero-btn{

            margin-top: 30px;

            background: white;

            color: #1565FF;

            text-decoration: none;

            padding: 14px 26px;

            border-radius: 14px;

            display: inline-block;

            font-weight: 600;

            transition: 0.3s;

            position: relative;

            z-index: 2;
        }

        .hero-btn:hover{

            transform: translateY(-4px);

            color: #1565FF;
        }

        /* MENU */

        .menu-section{

            padding-bottom: 80px;
        }

        .menu-card{

            background: white;

            border-radius: 30px;

            padding: 35px;

            height: 100%;

            transition: 0.3s;

            border: 1px solid #EEF3FC;

            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        }

        .menu-card:hover{

            transform: translateY(-6px);

            box-shadow: 0 12px 30px rgba(21,101,255,0.08);
        }

        .menu-icon{

            width: 80px;

            height: 80px;

            background: rgba(21,101,255,0.1);

            border-radius: 22px;

            display: flex;

            justify-content: center;

            align-items: center;

            margin-bottom: 25px;
        }

        .menu-icon i{

            font-size: 34px;

            color: #1565FF;
        }

        .menu-card h4{

            color: #0B1F66;

            font-weight: 700;

            margin-bottom: 15px;
        }

        .menu-card p{

            color: #6c757d;

            line-height: 1.8;

            margin-bottom: 25px;
        }

        .menu-link{

            text-decoration: none;

            color: #1565FF;

            font-weight: 600;
        }

        /* MOBILE */

        @media(max-width: 991px){

            .topbar{

                padding: 15px 20px;
            }

            .hero-box{

                padding: 40px 30px;
            }

            .hero-title{

                font-size: 34px;
            }

            .profile-name{

                display: none;
            }
        }

    </style>

</head>

<body>

<!-- TOPBAR -->
<div class="topbar">

    <!-- LOGO -->
    <img src="{{ asset('logo-navbar.png') }}"
         class="logo">

    <!-- PROFILE -->
    <div class="dropdown">

        <button class="profile-btn"
                data-bs-toggle="dropdown">

            {{-- FOTO --}}
            @if(auth()->user()->foto)

                <img src="{{ asset('storage/'.auth()->user()->foto) }}"
                     class="profile-image">

            @else

                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                     class="profile-image">

            @endif

            <div class="text-start">

                <p class="profile-name">

                    {{ auth()->user()->name }}

                </p>

                <small class="text-secondary">

                    User

                </small>

            </div>

            <i class="bi bi-chevron-down text-secondary"></i>

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
<section class="hero">

    <div class="container">

        <div class="hero-box">

            <h1 class="hero-title">

                Selamat Datang di
                FarmLab Access

            </h1>

            <p class="hero-text">

                Sistem peminjaman alat laboratorium farmasi
                modern untuk membantu proses peminjaman
                barang menjadi lebih cepat, aman,
                dan terstruktur.

            </p>

            <a href="/peminjaman"
               class="hero-btn">

                <i class="bi bi-arrow-right-circle me-2"></i>
                Mulai Peminjaman

            </a>

        </div>

    </div>

</section>

<!-- MENU -->
<section class="menu-section">

    <div class="container">

        <div class="row g-4">

            <!-- BARANG -->
            <div class="col-lg-4">

                <div class="menu-card">

                    <div class="menu-icon">

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <h4>Data Barang</h4>

                    <p>

                        Lihat seluruh alat dan barang
                        laboratorium yang tersedia.

                    </p>

                    <a href="/barang"
                       class="menu-link">

                        Lihat Barang →
                    </a>

                </div>

            </div>

            <!-- PEMINJAMAN -->
            <div class="col-lg-4">

                <div class="menu-card">

                    <div class="menu-icon">

                        <i class="bi bi-journal-text"></i>

                    </div>

                    <h4>Peminjaman</h4>

                    <p>

                        Ajukan peminjaman alat
                        laboratorium dengan mudah.

                    </p>

                    <a href="/peminjaman"
                       class="menu-link">

                        Buka Peminjaman →
                    </a>

                </div>

            </div>

            <!-- SOP -->
            <div class="col-lg-4">

                <div class="menu-card">

                    <div class="menu-icon">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                    <h4>SOP Barang</h4>

                    <p>

                        Lihat SOP penggunaan alat
                        laboratorium sebelum meminjam.

                    </p>

                    <a href="/sop"
                       class="menu-link">

                        Lihat SOP →
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>