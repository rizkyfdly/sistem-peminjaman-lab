<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Manajemen User</title>

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

    .page-header{
        background:white;
        padding:30px;
        border-radius:25px;
        box-shadow:0 5px 20px rgba(0,0,0,.05);
        margin-bottom:25px;
    }

    .page-title{
        color:#0B1F66;
        font-weight:800;
        margin:0;
    }

    .page-subtitle{
        color:#6c757d;
        margin-top:8px;
        margin-bottom:0;
    }

    .back-btn{
        text-decoration:none;
        color:#0B1F66;
        font-weight:600;
    }

    .btn-add{
        background:#1565FF;
        color:white;
        border-radius:14px;
        padding:12px 20px;
        text-decoration:none;
        font-weight:600;
    }

    .btn-add:hover{
        background:#0B1F66;
        color:white;
    }

    .stat-card{
        background:white;
        border-radius:22px;
        padding:25px;
        box-shadow:0 5px 20px rgba(0,0,0,.05);
        height:100%;
        transition:.3s;
    }

    .stat-card:hover{
        transform:translateY(-5px);
    }

    .stat-icon{
        width:60px;
        height:60px;
        border-radius:16px;
        background:#EAF1FF;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .stat-icon i{
        color:#1565FF;
        font-size:28px;
    }

    .stat-number{
        font-size:34px;
        font-weight:800;
        color:#0B1F66;
        margin:10px 0 0;
    }

    .stat-label{
        color:#6c757d;
        margin:0;
    }

    .table-card{
        background:white;
        border-radius:25px;
        padding:25px;
        margin-top:25px;
        box-shadow:0 5px 20px rgba(0,0,0,.05);
    }

    .search-box{
        border-radius:14px;
        padding:12px 15px;
        border:1px solid #E6ECF7;
    }

    .user-photo{
        width:52px;
        height:52px;
        border-radius:50%;
        object-fit:cover;
    }

    .badge-admin{
        background:#1565FF;
        color:white;
        padding:8px 15px;
        border-radius:30px;
        font-size:13px;
    }

    .badge-user{
        background:#EAF1FF;
        color:#1565FF;
        padding:8px 15px;
        border-radius:30px;
        font-size:13px;
    }

    .btn-edit{
        background:#1565FF;
        color:white;
        border:none;
        border-radius:10px;
    }

    .btn-delete{
        background:#dc3545;
        color:white;
        border:none;
        border-radius:10px;
    }

    .table{
        vertical-align:middle;
    }

    .mobile-card{
        display:none;
    }

    @media(max-width:768px){

        .page-header{
            padding:20px;
        }

        .btn-add{
            width:100%;
            text-align:center;
            margin-top:15px;
        }

        .desktop-table{
            display:none;
        }

        .mobile-card{
            display:block;
        }

        .user-card{
            background:white;
            border-radius:20px;
            padding:20px;
            margin-bottom:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.05);
        }

    }

</style>

</head>

<body>

<div class="container py-4">

<a href="/dashboard" class="back-btn">

    <i class="bi bi-arrow-left"></i>
    Kembali ke Dashboard

</a>

<div class="page-header mt-3">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h2 class="page-title">

                👥 Manajemen User

            </h2>

            <p class="page-subtitle">

                Kelola seluruh akun pengguna FarmLab Access

            </p>

        </div>

        <a href="{{ route('admin.users.create') }}"
           class="btn-add">

            <i class="bi bi-plus-circle"></i>
            Tambah User

        </a>

    </div>

</div>

<!-- STATISTIK -->

<div class="row g-4">

    <div class="col-md-4">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-people-fill"></i>

            </div>

            <h2 class="stat-number">

                {{ \App\Models\User::count() }}

            </h2>

            <p class="stat-label">

                Total User

            </p>

        </div>

    </div>

    <div class="col-md-4">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-shield-fill-check"></i>

            </div>

            <h2 class="stat-number">

                {{ \App\Models\User::where('role','admin')->count() }}

            </h2>

            <p class="stat-label">

                Total Admin

            </p>

        </div>

    </div>

    <div class="col-md-4">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-person-fill"></i>

            </div>

            <h2 class="stat-number">

                {{ \App\Models\User::where('role','user')->count() }}

            </h2>

            <p class="stat-label">

                Total User Biasa

            </p>

        </div>

    </div>

</div>

<!-- TABEL -->

<div class="table-card">

    <input type="text"
           class="form-control search-box mb-4"
           placeholder="Cari user...">

    <!-- DESKTOP -->

    <div class="table-responsive desktop-table">

        <table class="table">

            <thead>

                <tr>

                    <th>User</th>
                    <th>NIM/NIP</th>
                    <th>Role</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @foreach($users as $u)

                <tr>

                    <td>

                        <div class="d-flex align-items-center gap-3">

                            @if($u->foto)

                                <img src="{{ asset('storage/'.$u->foto) }}"
                                     class="user-photo">

                            @else

                                <img src="https://ui-avatars.com/api/?name={{ $u->name }}"
                                     class="user-photo">

                            @endif

                            <div>

                                <div class="fw-bold">

                                    {{ $u->name }}

                                </div>

                                <small class="text-muted">

                                    {{ $u->email }}

                                </small>

                            </div>

                        </div>

                    </td>

                    <td>{{ $u->nim_nip }}</td>

                    <td>

                        @if($u->role == 'admin')

                            <span class="badge-admin">Admin</span>

                        @else

                            <span class="badge-user">User</span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('admin.users.edit',$u->id) }}"
                           class="btn btn-edit btn-sm">

                            <i class="bi bi-pencil"></i>

                        </a>

                        <form action="{{ route('admin.users.destroy',$u->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus user ini?')"
                                    class="btn btn-delete btn-sm">

                                <i class="bi bi-trash"></i>

                            </button>
                            
                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <!-- MOBILE -->

    <div class="mobile-card">

        @foreach($users as $u)

            <div class="user-card">

                <div class="d-flex align-items-center gap-3 mb-3">

                    @if($u->foto)

                        <img src="{{ asset('storage/'.$u->foto) }}"
                             class="user-photo">

                    @else

                        <img src="https://ui-avatars.com/api/?name={{ $u->name }}"
                             class="user-photo">

                    @endif

                    <div>

                        <h6 class="mb-0">

                            {{ $u->name }}

                        </h6>

                        <small class="text-muted">

                            {{ $u->email }}

                        </small>

                    </div>

                </div>

                <p class="mb-2">

                    <strong>NIM/NIP:</strong>
                    {{ $u->nim_nip }}

                </p>

                <p>

                    @if($u->role == 'admin')

                        <span class="badge-admin">Admin</span>

                    @else

                        <span class="badge-user">User</span>

                    @endif

                </p>

                <div class="d-flex gap-2">

                    <a href="{{ route('admin.users.edit',$u->id) }}"
                       class="btn btn-edit btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('admin.users.destroy',$u->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Hapus user ini?')"
                                class="btn btn-delete btn-sm">

                            Hapus

                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>

</div>

</body>
</html>