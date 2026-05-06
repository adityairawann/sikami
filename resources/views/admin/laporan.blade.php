@extends('layouts.admin')

@section('content')

<h2>Laporan</h2>
<p style="color:gray;">Admin > Laporan</p>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:800px; box-shadow:0 0 5px #ccc;">

    <!-- FILTER (AUTO SUBMIT TANPA TOMBOL) -->
    <form method="GET" action="/admin/laporan" style="margin-bottom:15px;">
        
        Periode:
        <select>
            <option>2026</option>
        </select>

        User:
        <select name="id_user" onchange="this.form.submit()" style="padding:5px;">
            <option value="">-- Pilih User --</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" {{ request('id_user') == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>

    </form>

    <!-- HASIL -->
    @if($penilaian)
    <div style="background:white; padding:15px; border:1px solid #ccc;">

        <b>Ringkasan Penilaian:</b><br><br>

        - Total Skor : {{ $totalSkor }} <br>
        - Status : {{ $status }} <br>
        - Area Kritis : {{ $areaKritis['nama'] ?? '-' }}

    </div>

    <br>

    <!-- TOMBOL PDF -->
    <div style="text-align:right;">
        <a href="/admin/laporan/pdf?id_user={{ request('id_user') }}"
           style="background:#e67e22; color:white; padding:10px 15px; border-radius:5px; text-decoration:none;">
           Cetak / Unduh PDF
        </a>
    </div>

    @endif

</div>

@endsection