@extends('layouts.admin')

@section('content')

<h2>Detail Penilaian</h2>

<div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
    
    <a href="javascript:history.back()" 
       style="text-decoration:none; font-size:22px; color:black;">
        ←
    </a>

    <h2 style="margin:0;">Tambah Pertanyaan</h2>

</div>

<p>Admin > Data Penilaian > Detail</p>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:800px;">

    <b>Periode:</b> {{ date('Y', strtotime($penilaian->tanggal)) }} <br>
    <b>User:</b> {{ $penilaian->user->name ?? '-' }} <br><br>

    <table style="width:100%; border-collapse:collapse;">
        <tr style="background:#e67e22; color:white;">
            <th>No</th>
            <th>Domain</th>
            <th>Skor</th>
        </tr>

        @foreach($hasil as $i => $h)
        <tr style="background:#f4e1d2; text-align:center;">
            <td>{{ $i+1 }}</td>
            <td>{{ $h['nama'] }}</td>
            <td>{{ $h['total'] }}</td>
        </tr>
        @endforeach
    </table>

    <br>

    <div style="background:#e67e22; color:white; padding:10px; border-radius:5px;">
        <b>Area Kritis:</b> {{ $areaKritis['nama'] }}
    </div>

</div>

@endsection