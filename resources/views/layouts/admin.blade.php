<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        .header {
            background: #e67e22;
            padding: 15px;
            color: white;
            font-weight: bold;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #f0f0f0;
            padding: 20px;
        }

        .menu a {
            display: block;
            background: #ddd;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: black;
            border-radius: 5px;
        }

        .menu a:hover {
            background: #e67e22;
            color: white;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: #fafafa;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        SIKAMI (ADMIN)
    </div>

    <div class="container">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="menu">
                <a href="/admin">Dashboard</a>
                <a href="/admin/users">Kelola User</a>
                <a href="/admin/domain">Domain Indeks KAMI</a>
                <a href="/admin/pertanyaan">Kelola Pertanyaan</a>
                <a href="/admin/penilaian">Data Penilaian</a>
                <a href="/admin/hasil">Hasil Evaluasi</a>
                <a href="/admin/laporan">Laporan</a>
                <a href="/logout">Logout</a>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>

    </div>

</body>
</html>