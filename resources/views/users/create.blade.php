<!DOCTYPE html>

<html lang="en">
<head>


<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Tambah User</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet">

<style>

    *{
        font-family:'Poppins',sans-serif;
    }

    body{
        background:#F5F8FF;
    }

    .form-card{
        background:white;
        border-radius:25px;
        padding:35px;
        box-shadow:0 5px 20px rgba(0,0,0,.05);
    }

    .page-title{
        color:#0B1F66;
        font-weight:800;
    }

    .page-subtitle{
        color:#6c757d;
    }

    .form-label{
        font-weight:600;
        color:#0B1F66;
    }

    .form-control,
    .form-select{

        border-radius:14px;
        padding:12px 15px;
        border:1px solid #E4EBF7;

    }

    .form-control:focus,
    .form-select:focus{

        box-shadow:none;
        border-color:#1565FF;

    }

    .btn-save{

        background:#1565FF;
        color:white;
        border:none;
        border-radius:14px;
        padding:12px 25px;
        font-weight:600;

    }

    .btn-save:hover{

        background:#0B1F66;
        color:white;

    }

    .btn-back{

        text-decoration:none;
        color:#0B1F66;
        font-weight:600;

    }

    .input-icon{

        position:relative;

    }

    .input-icon i{

        position:absolute;
        top:50%;
        left:15px;
        transform:translateY(-50%);
        color:#1565FF;

    }

    .input-icon input{

        padding-left:45px;

    }

    @media(max-width:768px){

        .form-card{

            padding:25px;

        }

    }

</style>

</head>

<body>

<div class="container py-5">

<a href="{{ route('admin.users.index') }}"
   class="btn-back">

    <i class="bi bi-arrow-left"></i>
    Kembali ke Manajemen User

</a>

<div class="form-card mt-3">

    <h2 class="page-title">

        👤 Tambah User Baru

    </h2>

    <p class="page-subtitle mb-4">

        Tambahkan akun pengguna baru ke dalam sistem FarmLab Access.

    </p>

    <form action="{{ route('admin.users.store') }}"
          method="POST">

        @csrf

        <div class="row g-4">

            <div class="col-md-6">

                <label class="form-label">

                    Nama Lengkap

                </label>

                <div class="input-icon">

                    <i class="bi bi-person"></i>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Masukkan nama lengkap"
                           required>

                </div>

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Email

                </label>

                <div class="input-icon">

                    <i class="bi bi-envelope"></i>

                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Masukkan email"
                           required>

                </div>

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Password

                </label>

                <div class="input-icon">

                    <i class="bi bi-lock"></i>

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>

                </div>

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    NIM / NIP

                </label>

                <input type="text"
                       name="nim_nip"
                       class="form-control"
                       placeholder="Masukkan NIM atau NIP">

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Jurusan

                </label>

                <input type="text"
                       name="jurusan"
                       class="form-control"
                       placeholder="Masukkan jurusan">

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Kelas

                </label>

                <input type="text"
                       name="kelas"
                       class="form-control"
                       placeholder="Masukkan kelas">

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Role

                </label>

                <select name="role"
                        class="form-select">

                    <option value="user">

                        User

                    </option>

                    <option value="admin">

                        Admin

                    </option>

                </select>

            </div>

        </div>

        <div class="mt-4">

            <button type="submit"
                    class="btn-save">

                <i class="bi bi-check-circle"></i>
                Simpan User

            </button>

        </div>

    </form>

</div>

</div>

</body>
</html>
