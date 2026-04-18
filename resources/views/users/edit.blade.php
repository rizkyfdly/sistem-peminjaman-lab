<h1>Edit User</h1>

<form action="/users/{{ $user->id }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $user->name }}"><br>
    <input type="email" name="email" value="{{ $user->email }}"><br>

    <input type="text" name="nim_nip" value="{{ $user->nim_nip }}"><br>
    <input type="text" name="jurusan" value="{{ $user->jurusan }}"><br>
    <input type="text" name="kelas" value="{{ $user->kelas }}"><br>

    <select name="role">
        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
    </select><br>

    <button>Update</button>
</form>