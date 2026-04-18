<h1>Data User</h1>

<a href="/users/create">Tambah User</a>

<table border="1">
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
            <a href="/users/{{ $u->id }}/edit">Edit</a>

            <form action="/users/{{ $u->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>