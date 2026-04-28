<h1>Dashboard</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>
<p>Role: {{ auth()->user()->role }}</p>

<hr>

<h3>Menu:</h3>

<ul>
    <li><a href="/">Dashboard</a></li>

    <li><a href="/barang">Barang</a></li>

    <li><a href="/peminjaman">Peminjaman</a></li>

    

    <li><a href="/sop">SOP Barang</a></li>

    @if(auth()->user()->role == 'admin')
        <li><a href="/users">Manajemen User</a></li>
        <li><a href="/detail-peminjaman">Detail Peminjaman</a></li>
    @endif
</ul>

<hr>

<form action="/logout" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>