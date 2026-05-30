<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit User</title>

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

        .back-btn{
            text-decoration:none;
            color:#0B1F66;
            font-weight:600;
        }

        .form-card{

            background:white;

            border-radius:28px;

            padding:35px;

            margin-top:20px;

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

            border:1px solid #E5EAF5;
        }

        .form-control:focus,
        .form-select:focus{

            border-color:#1565FF;

            box-shadow:none;
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

        .user-preview{

            text-align:center;

            margin-bottom:30px;
        }

        .user-preview img{

            width:120px;

            height:120px;

            border-radius:50%;

            object-fit:cover;

            border:5px solid #EAF1FF;
        }

        .user-name{

            margin-top:15px;

            font-size:22px;

            font-weight:700;

            color:#0B1F66;
        }

        .user-role{

            display:inline-block;

            background:#EAF1FF;

            color:#1565FF;

            padding:6px 15px;

            border-radius:30px;

            font-size:14px;

            font-weight:600;
        }

        @media(max-width:768px){

            .form-card{

                padding:25px;
            }

            .page-title{

                font-size:26px;
            }

            .btn-save{

                width:100%;
            }
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- BACK -->
    <a href="{{ route('admin.users.index') }}"
       class="back-btn">

        <i class="bi bi-arrow-left"></i>
        Kembali ke Manajemen User

    </a>

    <!-- CARD -->
    <div class="form-card">

        <h2 class="page-title">

            ✏️ Edit User

        </h2>

        <p class="page-subtitle">

            Perbarui data pengguna FarmLab Access

        </p>

        <hr class="my-4">

        <!-- PREVIEW USER -->
        <div class="user-preview">

            @if($user->foto)

                <img src="{{ asset('storage/'.$user->foto) }}">

            @else

                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=1565FF&color=fff">
            @endif

            <div class="user-name">

                {{ $user->name }}

            </div>

            <div class="user-role">

                {{ ucfirst($user->role) }}

            </div>

        </div>

        <!-- FORM -->
        <form action="{{ route('admin.users.update', $user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- NAMA -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Nama Lengkap

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $user->name }}"
                           class="form-control"
                           required>

                </div>

                <!-- EMAIL -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           value="{{ $user->email }}"
                           class="form-control"
                           required>

                </div>

                <!-- NIM/NIP -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        NIM / NIP

                    </label>

                    <input type="text"
                           name="nim_nip"
                           value="{{ $user->nim_nip }}"
                           class="form-control">

                </div>

                <!-- ROLE -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Role

                    </label>

                    <select name="role"
                            class="form-select">

                        <option value="user"
                            {{ $user->role == 'user' ? 'selected' : '' }}>

                            User

                        </option>

                        <option value="admin"
                            {{ $user->role == 'admin' ? 'selected' : '' }}>

                            Admin

                        </option>

                    </select>

                </div>

                <!-- JURUSAN -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <input type="text"
                           name="jurusan"
                           value="{{ $user->jurusan }}"
                           class="form-control">

                </div>

                <!-- KELAS -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Kelas

                    </label>

                    <input type="text"
                           name="kelas"
                           value="{{ $user->kelas }}"
                           class="form-control">

                </div>

            </div>

            <button type="submit"
                    class="btn-save">

                <i class="bi bi-check-circle"></i>
                Update User

            </button>

        </form>

    </div>

</div>

</body>
</html>