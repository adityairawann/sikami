@extends('layouts.app')

@section('content')

<h2>Dashboard (User)</h2>

<div class="card">
    <b>Penilaian Terakhir:</b><br>
    {{ $lastPenilaian->tanggal ?? '-' }}
</div>

<div class="card">
    <b>Status:</b><br>
    {{ $lastPenilaian ? 'Sudah dinilai' : 'Belum dinilai' }}
</div>

<br>

<a href="{{ route('penilaian') }}" class="btn">Mulai Penilaian</a>
<a href="{{ route('laporan') }}" class="btn">Lihat Laporan</a>

@endsection