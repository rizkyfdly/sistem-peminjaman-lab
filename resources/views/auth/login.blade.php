<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - FarmLab Access</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .login-section{

            min-height: 100vh;

            position: relative;

            overflow: hidden;
        }

        /* LEFT */

        .login-left{

            position: relative;

            min-height: 100vh;

            overflow: hidden;
        }

        .login-bg{

            position: absolute;

            width: 100%;

            height: 100%;

            object-fit: cover;
        }

        .login-overlay{

            position: absolute;

            width: 100%;

            height: 100%;

            background:
                linear-gradient(
                    rgba(11,31,102,0.75),
                    rgba(245, 245, 245, 0.75)
                );
        }

        .login-content{

            position: relative;

            z-index: 2;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            flex-direction: column;

            text-align: center;

            padding: 40px;
        }

        .login-logo{

            max-width: 450px;
        }

        .login-text{

            color: rgba(255,255,255,0.85);

            font-size: 17px;

            line-height: 1.9;

            max-width: 500px;
        }

        /* RIGHT */

        .login-right{

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 40px;
        }

        .login-card{

            width: 100%;

            max-width: 500px;

            background: white;

            padding: 50px;

            border-radius: 35px;

            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .login-title{

            color: #0B1F66;

            font-weight: 700;
        }

        /* INPUT */

        .form-control{

            height: 58px;

            border-radius: 16px;

            border: 1px solid #dcdfe4;

            padding-left: 18px;

            box-shadow: none !important;
        }

        .form-control:focus{

            border-color: #1565FF;
        }

        /* PASSWORD */

        .password-wrapper{

            position: relative;
        }

        .password-wrapper i{

            position: absolute;

            top: 50%;

            right: 18px;

            transform: translateY(-50%);

            cursor: pointer;

            color: #888;
        }

        /* BUTTON */

        .btn-login{

            background: #1565FF;

            color: white;

            height: 58px;

            border-radius: 16px;

            border: none;

            font-weight: 600;
        }

        .btn-login:hover{

            background: #0B1F66;

            color: white;
        }

        .register-link{

            color: #1565FF;

            text-decoration: none;

            font-weight: 600;
        }

        .register-link:hover{

            color: #0B1F66;
        }

        @media(max-width: 991px){

            .login-left{

                min-height: 420px;
            }

            .login-content{

                min-height: 420px;
            }

            .login-right{

                min-height: auto;

                padding: 40px 20px;
            }

            .login-card{

                padding: 40px 25px;
            }

            .login-logo{

                max-width: 220px;
            }
        }

    </style>

</head>

<body>

<section class="login-section">

    <div class="container-fluid">

        <div class="row">

            <!-- LEFT -->
            <div class="col-lg-6 p-0">

                <div class="login-left">

                    <!-- IMAGE -->
<img src="https://images.unsplash.com/photo-1532187643603-ba119ca4109e?q=80&w=1200&auto=format&fit=crop"
                         class="login-bg">
                    <!-- OVERLAY -->
                    <div class="login-overlay"></div>

                    <!-- CONTENT -->
                    <div class="login-content">

                        <img src="{{ asset('logo-lab-fix.png') }}"
                             class="login-logo img-fluid mb-4">

                        <p class="login-text">

                            Sistem informasi peminjaman
                            laboratorium farmasi yang
                            modern, cepat, dan terorganisir.

                        </p>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-6 p-0">

                <div class="login-right">

                    <div class="login-card">

                        <h2 class="login-title mb-5 text-center">

                            Login Account

                        </h2>

                        <!-- ERROR -->
                        @if(session('error'))

                            <div class="alert alert-danger rounded-4">

                                {{ session('error') }}

                            </div>

                        @endif

                        <!-- FORM -->
                        <form method="POST"
                              action="/login">

                            @csrf

                            <!-- EMAIL -->
                            <div class="mb-4">

                                <label class="fw-semibold mb-2">

                                    Email

                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="Masukkan email">

                            </div>

                            <!-- PASSWORD -->
                            <div class="mb-3">

                                <label class="fw-semibold mb-2">

                                    Password

                                </label>

                                <div class="password-wrapper">

                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control pe-5"
                                           placeholder="Masukkan password">

                                    <i class="bi bi-eye"
                                       id="eyeIcon"
                                       onclick="togglePassword()"></i>

                                </div>

                            </div>

                            <!-- REMEMBER -->
                            <div class="form-check mb-4">

                                <input class="form-check-input"
                                       type="checkbox"
                                       id="remember">

                                <label class="form-check-label"
                                       for="remember">

                                    Ingat password saya

                                </label>

                            </div>

                            <!-- BUTTON -->
                            <button type="submit"
                                    class="btn btn-login w-100">

                                Login

                            </button>

                        </form>

                        <!-- REGISTER -->
                        <div class="text-center mt-4">

                            <p class="text-secondary mb-0">

                                Belum punya akun?

                                <a href="/register"
                                   class="register-link">

                                    Register sekarang

                                </a>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

    function togglePassword(){

        const password =
            document.getElementById('password');

        const eyeIcon =
            document.getElementById('eyeIcon');

        if(password.type === 'password'){

            password.type = 'text';

            eyeIcon.classList.remove('bi-eye');

            eyeIcon.classList.add('bi-eye-slash');

        }else{

            password.type = 'password';

            eyeIcon.classList.remove('bi-eye-slash');

            eyeIcon.classList.add('bi-eye');

        }

    }

</script>

</body>
</html>