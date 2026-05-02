<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>

<h1>Data User</h1>

{{-- TAMBAH USER --}}
<a href="{{ route('admin.users.create') }}">+ Tambah User</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>NIM/NIP</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    @foreach($users as $u)
    <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->nim_nip }}</td>
        <td>{{ $u->role }}</td>
        <td>

            {{-- EDIT --}}
            <a href="{{ route('admin.users.edit', $u->id) }}">Edit</a>

            {{-- DELETE --}}
            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus user ini?')">Hapus</button>
            </form>

        </td>
    </tr>
    @endforeach
</table>

</body>
</html>