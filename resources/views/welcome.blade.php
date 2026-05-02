<h1>Dashboard</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>
<p>Role: {{ auth()->user()->role }}</p>

<hr>

<h3>Menu:</h3>

<ul>
    <li><a href="{{ url('/') }}">Dashboard</a></li>

    <li><a href="{{ url('/barang') }}">Barang</a></li>

    <li><a href="{{ url('/peminjaman') }}">Peminjaman</a></li>

    <li><a href="{{ url('/sop') }}">SOP Barang</a></li>

    @if(auth()->user()->role == 'admin')
        <li>
            <a href="{{ route('admin.users.index') }}">Manajemen User</a>
        </li>
        <li><a href="{{ url('/admin/detail-peminjaman') }}">Detail Peminjaman</a></li>
    @endif
</ul>

<hr>

<form action="/logout" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>