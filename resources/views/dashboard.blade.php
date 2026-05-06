@extends('layouts.app')

@section('content')

<h2>Dashboard (User)</h2>

<div style="background:#eee; padding:20px; width:400px; margin-bottom:20px;">
    Penilaian Terakhir:
    {{ $penilaian ? date('Y-m-d', strtotime($penilaian->tanggal)) : '-' }}
</div>

<div style="background:#eee; padding:20px; width:400px;">
    <b>Status:</b><br>
    {{ $status }}
</div>

<br>

<a href="/penilaian" style="background:orange; color:white; padding:10px;">Mulai Penilaian</a>
<a href="/laporan" style="background:orange; color:white; padding:10px;">Lihat Laporan</a>

@endsection