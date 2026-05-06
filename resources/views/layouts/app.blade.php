<!DOCTYPE html>
<html>
<head>
    <title>SIKAMI</title>

    <!-- Bootstrap (biar rapi tanpa Node) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background: #eee;
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

        .sidebar a:hover {
            background: orange;
            color: white;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
        }

        .header {
            background: orange;
            color: white;
            padding: 10px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h4>SIKAMI</h4>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="/dashboard">Dashboard</a>
        <a href="/penilaian">Data Penilaian</a>
        <a href="/hasil-evaluasi">Hasil Evaluasi</a>
        <a href="/laporan">Laporan</a>
        <a href="/logout">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>