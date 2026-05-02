<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama</label><br>
    <input type="text" name="name" value="{{ $user->name }}"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ $user->email }}"><br><br>

    <label>NIM / NIP</label><br>
    <input type="text" name="nim_nip" value="{{ $user->nim_nip }}"><br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan" value="{{ $user->jurusan }}"><br><br>

    <label>Kelas</label><br>
    <input type="text" name="kelas" value="{{ $user->kelas }}"><br><br>

    <label>Role</label><br>
    <select name="role">
        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="{{ route('admin.users.index') }}">Kembali</a>

</body>
</html>