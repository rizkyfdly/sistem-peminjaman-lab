<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FarmLab Access</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

<style>

    *{
        font-family: 'Poppins', sans-serif;
    }

    body{

        background: #F5F9FF;

        overflow-x: hidden;
    }

    /* =========================
       NAVBAR
    ========================== */

    .navbar{

        position: fixed;

        top: 0;

        left: 0;

        width: 100%;

        z-index: 999;

        background: rgb(255, 255, 255);

        backdrop-filter: blur(10px);

        box-shadow: 0 2px 10px rgba(0,0,0,0.05);

        padding: 15px 0;
    }

    .navbar-brand img{

        height: 55px;
    }

    .nav-link{

        color: #0B1F66 !important;

        font-weight: 500;

        margin-right: 15px;

        position: relative;

        transition: 0.3s;
    }

    /* ANIMASI GARIS */

    .nav-link::after{

        content: '';

        position: absolute;

        left: 0;

        bottom: -5px;

        width: 0%;

        height: 2px;

        background: #1565FF;

        transition: 0.3s;
    }

    .nav-link:hover::after{

        width: 100%;
    }

    /* BUTTON LOGIN */

    .btn-login{

        background: #1565FF;

        color: white;

        border-radius: 10px;

        padding: 10px 25px;

        transition: 0.3s;

        font-weight: 500;
    }

    .btn-login:hover{

        background: #0B1F66;

        color: white;

        transform: translateY(-2px);
    }

    /* =========================
       HERO
    ========================== */

    .hero-home{

        min-height: 100vh;

        position: relative;

        overflow: hidden;

        padding-top: 90px;
    }

    .hero-bg{

        position: absolute;

        top: 0;

        left: 0;

        width: 100%;

        height: 100%;

        object-fit: cover;
    }

    .hero-overlay{

        position: absolute;

        top: 0;

        left: 0;

        width: 100%;

        height: 100%;

        background:
            linear-gradient(
                rgba(11,31,102,0.7),
                rgba(21,101,255,0.7)
            );
    }

    .hero-content{

        position: relative;

        z-index: 2;
    }

    .hero-title{

        font-size: 68px;

        font-weight: 800;

        line-height: 1.2;

        color: white;
    }

    .hero-title span{

        color: #A9C8FF;
    }

    .hero-text{

        font-size: 18px;

        max-width: 650px;

        line-height: 1.8;

        color: white;
    }

    @media(max-width: 991px){

        .hero-home{

            text-align: center;
        }

        .hero-title{

            font-size: 42px;
        }

        .hero-text{

            font-size: 16px;
        }
    }

    /* ABOUT */

    .about-title{

        font-size: 42px;

        color: #0B1F66;
    }

    .about-text{

        font-size: 17px;
    }

    .card{

        transition: 0.4s;
    }

    .card:hover{

        transform: translateY(-10px);

        box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
    }

    .card img{

        height: 260px;

        object-fit: cover;
    }

    /* CONTACT */

    .contact-section{

        background: #0B1F66;

        padding: 100px 0;
    }

    .contact-wrapper{

        background: white;

        border-radius: 35px;

        overflow: hidden;

        display: flex;

        align-items: center;
    }

    .contact-left{

        width: 45%;

        background: #ffffff;

        padding: 60px;

        text-align: center;
    }

    .contact-logo{

        max-width: 320px;
    }

    .contact-right{

        width: 55%;

        padding: 60px;
    }

    .contact-right h2{

        color: #0B1F66;
    }

    .contact-item{

        margin-bottom: 30px;
    }

    .contact-item h6{

        font-weight: 700;

        color: #1565FF;

        margin-bottom: 10px;
    }

    .contact-item p{

        margin: 0;

        color: #6c757d;

        font-size: 17px;
    }

    /* FOOTER */

    .footer{

        background: #08194F;

        text-align: center;

        padding: 22px;

        color: rgb(255, 255, 255);

        font-size: 20px;
    }

    @media(max-width: 991px){

        .contact-wrapper{

            flex-direction: column;
        }

        .contact-left,
        .contact-right{

            width: 100%;
        }

        .contact-left{

            padding: 40px 30px;
        }

        .contact-right{

            padding: 40px 30px;

            text-align: center;
        }

        .contact-logo{

            max-width: 240px;
        }
    }

</style>

</head>

<body>

{{-- =========================
     NAVBAR
========================= --}}

<nav class="navbar navbar-expand-lg">

    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand"
           href="/">

            <img src="{{ asset('logo-navbar.png') }}"
                 alt="FarmLab Access">

        </a>

        {{-- TOGGLE MOBILE --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a class="nav-link"
                       href="#">

                        Home

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="#about">

                        About

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="#contact">

                        Contact

                    </a>

                </li>

                {{-- LOGIN --}}
                <li class="nav-item nav-login">

                    <a href="/login"
                       class="btn btn-login">

                        Login

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="hero-home position-relative overflow-hidden">

    <!-- GAMBAR -->
    <img src="https://images.unsplash.com/photo-1576086213369-97a306d36557?q=80&w=1600&auto=format&fit=crop"
         class="hero-bg">

    <!-- OVERLAY BIRU -->
    <div class="hero-overlay"></div>

    <!-- CONTENT -->
    <div class="container min-vh-100 d-flex align-items-center position-relative">

        <div class="text-white hero-content">

            <h1 class="hero-title">

                Selamat Datang di
                <span>

                    FarmLab Access

                </span>

            </h1>

            <p class="hero-text mt-4">

                Sistem informasi peminjaman laboratorium
                farmasi modern untuk mempermudah
                pengelolaan alat laboratorium.

            </p>

            <a href="/login"
               class="btn btn-light px-4 py-3 rounded-4 mt-3 fw-semibold">

                Mulai Sekarang

            </a>

        </div>

    </div>

</section>

<!-- ABOUT -->
<section class="py-5 bg-white" id="about">

    <div class="container py-5">

        <!-- TITLE -->
        <div class="text-center mb-5">

            <span class="text-primary fw-semibold">

                Tentang Sistem

            </span>

            <h2 class="fw-bold mt-3 about-title">

                Sistem Informasi Peminjaman
                Laboratorium Farmasi

            </h2>

            <p class="text-secondary mt-3 about-text">

                Mempermudah proses peminjaman alat
                laboratorium secara digital dan modern.

            </p>

        </div>

        <!-- CARD -->
        <div class="row g-4">

            <!-- ITEM 1 -->
            <div class="col-lg-4">

                <div class="card border-0 shadow rounded-5 overflow-hidden">

                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=1200&auto=format&fit=crop"
                         class="card-img-top">

                    <div class="card-body p-4">

                        <h5 class="fw-bold">

                            Alat Laboratorium

                        </h5>

                        <p class="text-secondary mb-0">

                            Kelola berbagai alat laboratorium
                            dengan lebih mudah.

                        </p>

                    </div>

                </div>

            </div>

            <!-- ITEM 2 -->
            <div class="col-lg-4">

                <div class="card border-0 shadow rounded-5 overflow-hidden">

                    <img src="https://images.unsplash.com/photo-1532187643603-ba119ca4109e?q=80&w=1200&auto=format&fit=crop"
                         class="card-img-top">

                    <div class="card-body p-4">

                        <h5 class="fw-bold">

                            Proses Peminjaman

                        </h5>

                        <p class="text-secondary mb-0">

                            Pengajuan peminjaman menjadi
                            lebih cepat dan praktis.

                        </p>

                    </div>

                </div>

            </div>

            <!-- ITEM 3 -->
            <div class="col-lg-4">

                <div class="card border-0 shadow rounded-5 overflow-hidden">

                    <img src="https://images.unsplash.com/photo-1579165466741-7f35e4755660?q=80&w=1200&auto=format&fit=crop"
                         class="card-img-top">

                    <div class="card-body p-4">

                        <h5 class="fw-bold">

                            Pengelolaan Modern

                        </h5>

                        <p class="text-secondary mb-0">

                            Sistem digital yang modern
                            dan terorganisir.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CONTACT -->
<section class="contact-section" id="contact">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="contact-wrapper">

                    <!-- LEFT -->
                    <div class="contact-left">

                        <img src="{{ asset('logo-lab.png') }}"
                             class="contact-logo img-fluid">

                    </div>

                    <!-- RIGHT -->
                    <div class="contact-right">

                        <h2 class="fw-bold mb-4">

                            Contact Information

                        </h2>

                        <div class="contact-item">

                            <h6>Email</h6>

                            <p>

                                farmlabaccess@gmail.com

                            </p>

                        </div>

                        <div class="contact-item">

                            <h6>Location</h6>

                            <p>

                                Laboratorium Farmasi

                            </p>

                        </div>

                        <div class="contact-item">

                            <h6>System</h6>

                            <p>

                                FarmLab Access v1.0

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="footer">

    © 2026 FarmLab Access — Sistem Informasi Laboratorium Farmasi

</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>