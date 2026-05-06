@extends('layouts.app')

@section('content')

<h2>Laporan (User)</h2>

<div style="background:#eee; padding:20px; width:600px; border-radius:5px; margin-top:20px;">

    <b>Ringkasan Penilaian:</b><br><br>

    - Periode: {{ $periode }} <br>
    - Total Skor: {{ $totalSkor }} <br>
    - Status: {{ $status }} <br>
    - Area Kritis: {{ $areaKritis['nama'] }} (Domain terendah)
    - Persentase: {{ round($persen,2) }} %
</div>

<br>

<a href="{{ route('laporan.pdf') }}"
   style="background:orange; color:white; padding:10px 15px; text-decoration:none; border-radius:5px;">
    Cetak / Unduh PDF
</a>

@endsection