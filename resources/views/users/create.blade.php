<h1>Tambah User</h1>

<form action="/users" method="POST">
    @csrf

    <input name="name" placeholder="Nama"><br>
    <input name="email" placeholder="Email"><br>
    <input name="password" placeholder="Password"><br>
    <input name="nim_nip" placeholder="NIM/NIP"><br>
    <input name="jurusan" placeholder="Jurusan"><br>
    <input name="kelas" placeholder="Kelas"><br>

    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>

    <button type="submit">Simpan</button>
</form>