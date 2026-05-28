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

            padding-top: 95px;
        }

        /* TOPBAR */

        .topbar{

            background: white;

            padding: 18px 40px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            box-shadow: 0 2px 10px rgba(0,0,0,0.05);

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            z-index: 999;
        }

        .topbar img{

            height: 55px;
        }

        .user-info h5{

            margin: 0;

            color: #0B1F66;

            font-weight: 700;
        }

        .user-info p{

            margin: 0;

            color: #6c757d;

            font-size: 14px;
        }

        /* HERO */

        .hero{

            padding: 70px 0;
        }

        .hero-box{

            background:
                linear-gradient(
                    135deg,
                    #0B1F66,
                    #1565FF
                );

            border-radius: 35px;

            padding: 60px;

            color: white;

            position: relative;

            overflow: hidden;
        }

        .hero-box::before{

            content: '';

            position: absolute;

            width: 300px;

            height: 300px;

            background: rgba(255,255,255,0.08);

            border-radius: 50%;

            top: -120px;

            right: -100px;
        }

        .hero-title{

            font-size: 52px;

            font-weight: 800;

            line-height: 1.3;
        }

        .hero-text{

            font-size: 17px;

            max-width: 650px;

            line-height: 1.8;

            margin-top: 20px;
        }

        .hero-btn{

            background: white;

            color: #1565FF;

            border-radius: 14px;

            padding: 14px 28px;

            font-weight: 600;

            text-decoration: none;

            display: inline-block;

            margin-top: 25px;

            transition: 0.3s;
        }

        .hero-btn:hover{

            transform: translateY(-3px);

            color: #1565FF;
        }

        /* MENU CARD */

        .menu-section{

            padding-bottom: 80px;
        }

        .menu-card{

            background: white;

            border-radius: 28px;

            padding: 35px;

            text-align: center;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);

            transition: 0.3s;

            height: 100%;
        }

        .menu-card:hover{

            transform: translateY(-8px);
        }

        .menu-icon{

            width: 85px;

            height: 85px;

            background: rgba(21,101,255,0.1);

            border-radius: 20px;

            display: flex;

            justify-content: center;

            align-items: center;

            margin: auto;

            margin-bottom: 25px;
        }

        .menu-icon i{

            font-size: 38px;

            color: #1565FF;
        }

        .menu-card h4{

            color: #0B1F66;

            font-weight: 700;
        }

        .menu-card p{

            color: #6c757d;

            line-height: 1.8;
        }

        .menu-link{

            text-decoration: none;

            color: #1565FF;

            font-weight: 600;
        }

        /* LOGOUT */

        .logout-btn{

            background: #dc3545;

            border: none;

            color: white;

            padding: 10px 22px;

            border-radius: 12px;
        }

        /* MOBILE */

        @media(max-width: 991px){

            .topbar{

                flex-direction: column;

                gap: 15px;

                text-align: center;
            }

            .hero-box{

                padding: 40px 30px;
            }

            .hero-title{

                font-size: 36px;
            }

            .hero-text{

                font-size: 15px;
            }
        }

    </style>

</head>

<body>

<!-- TOPBAR -->
<div class="topbar">

    <!-- LOGO -->
    <img src="{{ asset('logo-navbar.png') }}">

    <!-- USER -->
    <div class="user-info">

        <h5>

            {{ auth()->user()->name }}

        </h5>

        <p>

            User Laboratory Access

        </p>

    </div>

    <!-- LOGOUT -->
    <form action="/logout"
          method="POST">

        @csrf

        <button type="submit"
                class="logout-btn">

            Logout

        </button>

    </form>

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

                Sistem peminjaman alat laboratorium
                farmasi modern untuk membantu
                proses peminjaman barang menjadi
                lebih cepat, aman, dan terstruktur.

            </p>

            <a href="/peminjaman"
               class="hero-btn">

                Mulai Peminjaman

            </a>

        </div>

    </div>

</section>

<!-- MENU -->
<section class="menu-section">

    <div class="container">

        <div class="row g-4">

            <!-- CARD 1 -->
            <div class="col-lg-4">

                <div class="menu-card">

                    <div class="menu-icon">

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <h4>Data Barang</h4>

                    <p>

                        Lihat seluruh alat dan
                        barang laboratorium yang
                        tersedia.

                    </p>

                    <a href="/barang"
                       class="menu-link">

                        Lihat Barang

                    </a>

                </div>

            </div>

            <!-- CARD 2 -->
            <div class="col-lg-4">

                <div class="menu-card">

                    <div class="menu-icon">

                        <i class="bi bi-journal-text"></i>

                    </div>

                    <h4>Peminjaman</h4>

                    <p>

                        Ajukan peminjaman alat
                        laboratorium dengan
                        mudah dan cepat.

                    </p>

                    <a href="/peminjaman"
                       class="menu-link">

                        Buka Peminjaman

                    </a>

                </div>

            </div>

            <!-- CARD 3 -->
            <div class="col-lg-4">

                <div class="menu-card">

                    <div class="menu-icon">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                    <h4>SOP Barang</h4>

                    <p>

                        Lihat SOP penggunaan alat
                        laboratorium sebelum
                        melakukan peminjaman.

                    </p>

                    <a href="/sop"
                       class="menu-link">

                        Lihat SOP

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

</body>
</html>