<!DOCTYPE html>
<html>
<head>
    <title>SIKAMI</title>
   <style>
body { margin:0; font-family: Arial; background:#ddd; }

.header {
    background: #e67e22;
    color: white;
    padding: 15px;
    font-weight: bold;
}

.sidebar {
    width: 200px;
    background: #eee;
    height: 100vh;
    float: left;
    padding: 15px;
}

.sidebar a {
    display: block;
    padding: 10px;
    margin-bottom: 10px;
    background: #ddd;
    text-decoration: none;
    color: black;
    border-radius: 5px;
}

.sidebar a.active {
    background: #e67e22;
    color: white;
}

.content {
    margin-left: 220px;
    padding: 20px;
}

.card {
    background: #eee;
    padding: 15px;
    border-radius: 8px;
    width: 300px;
    margin-bottom: 15px;
}

.btn {
    background: #e67e22;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
}
</style>
</head>
<body>

<div class="sidebar">
    <h3>SIKAMI</h3>

    @if(auth()->check() && auth()->user()->role == 'user')
        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="/data-penilaian" class="{{ request()->is('data-penilaian') ? 'active' : '' }}">Data Penilaian</a>
        <a href="/hasil" class="{{ request()->is('hasil') ? 'active' : '' }}">Hasil Evaluasi</a>
        <a href="/laporan" class="{{ request()->is('laporan') ? 'active' : '' }}">Laporan</a>
    @endif

    <a href="/logout">Logout</a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>