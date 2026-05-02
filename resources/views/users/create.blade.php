<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>

<h1>Tambah User</h1>

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <label>Nama</label><br>
    <input name="name" placeholder="Nama"><br><br>

    <label>Email</label><br>
    <input name="email" placeholder="Email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password" placeholder="Password"><br><br>

    <label>NIM/NIP</label><br>
    <input name="nim_nip" placeholder="NIM/NIP"><br><br>

    <label>Jurusan</label><br>
    <input name="jurusan" placeholder="Jurusan"><br><br>

    <label>Kelas</label><br>
    <input name="kelas" placeholder="Kelas"><br><br>

    <label>Role</label><br>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('admin.users.index') }}">Kembali</a>

</body>
</html>