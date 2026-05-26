<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register - FarmLab Access</title>

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

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 30px;
        }

        .register-card{

            width: 100%;

            max-width: 520px;

            background: white;

            padding: 45px;

            border-radius: 30px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .register-title{

            color: #0B1F66;

            font-weight: 700;
        }

        .form-control{

            height: 56px;

            border-radius: 14px;

            box-shadow: none !important;
        }

        .form-control:focus{

            border-color: #1565FF;
        }

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

        .btn-register{

            height: 56px;

            border-radius: 14px;

            background: #1565FF;

            border: none;

            color: white;

            font-weight: 600;
        }

        .btn-register:hover{

            background: #0B1F66;
        }

        .login-link{

            color: #1565FF;

            text-decoration: none;

            font-weight: 600;
        }

    </style>

</head>

<body>

<div class="register-card">

    <h2 class="register-title text-center mb-5">

        Register Account

    </h2>

    <!-- ERROR -->
    @if ($errors->any())

        <div class="alert alert-danger rounded-4">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- FORM -->
    <form method="POST"
          action="/register">

        @csrf

        <!-- NAME -->
        <div class="mb-4">

            <label class="fw-semibold mb-2">

                Nama

            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Masukkan nama">

        </div>

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
        <div class="mb-4">

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

        <!-- CONFIRM -->
        <div class="mb-4">

            <label class="fw-semibold mb-2">

                Konfirmasi Password

            </label>

            <div class="password-wrapper">

                <input type="password"
                       name="password_confirmation"
                       id="confirmPassword"
                       class="form-control pe-5"
                       placeholder="Konfirmasi password">

                <i class="bi bi-eye"
                   id="eyeIcon2"
                   onclick="toggleConfirmPassword()"></i>

            </div>

        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="btn btn-register w-100">

            Register

        </button>

    </form>

    <!-- LOGIN -->
    <div class="text-center mt-4">

        <p class="text-secondary mb-0">

            Sudah punya akun?

            <a href="/login"
               class="login-link">

                Login sekarang

            </a>

        </p>

    </div>

</div>

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

    function toggleConfirmPassword(){

        const password =
            document.getElementById('confirmPassword');

        const eyeIcon =
            document.getElementById('eyeIcon2');

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