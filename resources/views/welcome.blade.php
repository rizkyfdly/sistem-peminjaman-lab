<h1>Dashboard</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>
<p>Role: {{ auth()->user()->role }}</p>

<hr>

<h3>Menu:</h3>

<ul>

    <li><a href="/">Dashboard</a></li>

    <li><a href="/barang">Barang</a></li>

    @if(auth()->user()->role == 'admin')
        <li><a href="/users">Manajemen User</a></li>
    @endif

    <li><a href="#">Peminjaman</a></li>

</ul>

<hr>

<form action="/logout" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>