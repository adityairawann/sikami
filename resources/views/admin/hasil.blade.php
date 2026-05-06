@extends('layouts.admin')

@section('content')

<h2>Hasil Evaluasi</h2>
<p style="color:gray;">Admin > Hasil Evaluasi</p>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:800px; box-shadow:0 0 5px #ccc;">

    <!-- DROPDOWN USER -->
    <form method="GET" action="/admin/hasil" style="margin-bottom:15px;">

        Pilih User:
        <select name="id_user" onchange="this.form.submit()" style="padding:5px;">
            <option value="">-- Pilih User --</option>

            @foreach($users as $u)
                <option value="{{ $u->id }}" {{ request('id_user') == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>

    </form>

    <!-- DATA -->
    @if($penilaian)

    <table style="width:100%; border-collapse:collapse;">
        <tr style="background:#e67e22; color:white;">
            <th style="padding:10px;">No</th>
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

    <b>Total Skor:</b> {{ $totalSkor }} <br>

    <b>Status:</b> {{ $status }} 
    ({{ number_format($persentase,2) }}%) <br>

    <b>Area Kritis (Domain skor terendah):</b><br>
    {{ $areaKritis['nama'] ?? '-' }}

</div>
    @else
        <p style="color:red;">Silakan pilih user terlebih dahulu</p>
    @endif

</div>

@endsection