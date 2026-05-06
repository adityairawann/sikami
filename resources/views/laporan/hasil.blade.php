@extends('layouts.app')

@section('content')

<div style="padding:20px;">

<h2 style="margin-bottom:20px;">Hasil Evaluasi (User)</h2>

<div style="background:white; padding:20px; border-radius:5px; width:600px;">

<table style="width:100%; border-collapse:collapse;">
    <tr style="background:#e67e22; color:white;">
        <th style="padding:10px;">No</th>
        <th>Domain</th>
        <th>Skor</th>
    </tr>

    @forelse($hasil as $i => $h)
    <tr style="background:#f4e1d2; text-align:center;">
        <td style="padding:10px;">{{ $i+1 }}</td>
        <td>{{ $h['nama'] }}</td>
        <td>{{ $h['total'] }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="3" style="text-align:center; padding:15px;">
            Belum ada hasil evaluasi
        </td>
    </tr>
    @endforelse

</table>

{{-- AREA KRITIS --}}
@if(!empty($areaKritis))
<div style="margin-top:20px; background:#e67e22; color:white; padding:15px; border-radius:5px;">
    <b>Area Kritis (Domain Terendah):</b><br>
    {{ $areaKritis['nama'] }}
</div>
@endif

</div>

</div>

@endsection