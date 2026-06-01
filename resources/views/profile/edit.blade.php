<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Profil</title>

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
        }

        .edit-card{

            background: white;

            border-radius: 30px;

            padding: 40px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .page-title{

            color: #0B1F66;

            font-weight: 800;
        }

        .form-control{

            border-radius: 14px;

            padding: 12px;
        }

        .btn-save{

            background: #1565FF;

            color: white;

            border: none;

            padding: 12px 24px;

            border-radius: 14px;

            font-weight: 600;
        }

        .btn-save:hover{

            background: #0B1F66;
        }

        .profile-image{

            width: 120px;

            height: 120px;

            object-fit: cover;

            border-radius: 50%;

            border: 4px solid #EAF1FF;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="edit-card mx-auto"
         style="max-width:700px;">

        <h1 class="page-title mb-4">

            Edit Profil

        </h1>

        {{-- FOTO --}}
        <div class="text-center mb-4">

            @if($user->foto)

                <img src="{{ asset('storage/'.$user->foto) }}"
                     class="profile-image">

            @else

                <img src="https://ui-avatars.com/api/?name={{ $user->name }}"
                     class="profile-image">

            @endif

        </div>

        <form action="{{ route('profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- FOTO --}}
            <div class="mb-3">

                <label class="form-label">

                    Foto Profil

                </label>

                <input type="file"
                       name="foto"
                       class="form-control">

            </div>

            {{-- NAMA --}}
            <div class="mb-3">

                <label class="form-label">

                    Nama

                </label>

                <input type="text"
                       name="name"
                       value="{{ $user->name }}"
                       class="form-control">

            </div>

            {{-- EMAIL --}}
            <div class="mb-4">

                <label class="form-label">

                    Email

                </label>

                <input type="email"
                       name="email"
                       value="{{ $user->email }}"
                       class="form-control">

            </div>

            {{-- NIM / NIP --}}
            <div class="mb-3">

                <label class="form-label">

                    NIM / NIP

                </label>

                <input type="text"
                    name="nim_nip"
                    value="{{ $user->nim_nip }}"
                    class="form-control">

            </div>

            {{-- JURUSAN --}}
            <div class="mb-4">

                <label class="form-label">

                    Jurusan

                </label>

                <input type="text"
                    name="jurusan"
                    value="{{ $user->jurusan }}"
                    class="form-control">

            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="btn-save">

                <i class="bi bi-check-circle"></i>
                Simpan Perubahan

            </button>

        </form>

    </div>

</div>

</body>
</html>