@extends('layouts.admin')

@section('content')

<h2>Dashboard Admin</h2>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

    <div style="background:#ddd; padding:20px;">
        <b>Total User</b><br>
        <h3>{{ $totalUser }}</h3>
    </div>

    <div style="background:#ddd; padding:20px;">
        <b>Total Pertanyaan</b><br>
        <h3>{{ $totalPertanyaan }}</h3>
    </div>

    <div style="background:#ddd; padding:20px;">
        <b>Total Penilaian</b><br>
        <h3>{{ $totalPenilaian }}</h3>
    </div>

    <div style="background:#ddd; padding:20px;">
        <b>Penilaian Terbaru</b><br>
        <h3>
            {{ $penilaianTerbaru ? $penilaianTerbaru->user->name : '-' }}
        </h3>
    </div>

</div>

<br>

<a href="/admin/penilaian" style="background:orange; padding:10px; color:white;">Lihat Data Penilaian</a>
<a href="/admin/laporan" style="background:orange; padding:10px; color:white;">Lihat Laporan</a>

@endsection